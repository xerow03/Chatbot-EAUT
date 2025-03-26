"use client";
import { History, Trash2, X } from "lucide-react";
import { ChatDisplay } from "@/app/client/chats/components/chats-display";
import { ChatsList } from "@/app/client/chats/components/chats-list";
import { Separator } from "@/components/ui/separator";
import {
  ResizableHandle,
  ResizablePanel,
  ResizablePanelGroup,
} from "@/components/ui/resizable";
import { Button } from "@/components/ui/button";
import { TooltipProvider } from "@/components/ui/tooltip";
import { toast } from "sonner";
import { MouseEvent, useCallback, useState } from "react";
import { useChats, useCurrentChat } from "@/app/client/hooks/use-chats";
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/components/ui/dialog";
import { Input } from "@/components/ui/input";
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from "@/components/ui/form";
import { useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { z } from "zod";
import { Textarea } from "@/components/ui/textarea";
import { errors } from "@/app/common/utils/ultils";
import { fetcher } from "@/app/common/utils/fetcher";
import { Response } from "@/app/common/types/res/response.type";
import Conversations from "@/app/common/types/interface/Conversations";
import { useSession } from "next-auth/react";
import {
  AlertDialog,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogTrigger,
} from "@/components/ui/alert-dialog";
import Spinner from "@/components/ui/spinner";
import { Drawer } from "vaul";

interface ChatsProps {
  defaultLayout: number[] | undefined;
  defaultCollapsed?: boolean;
}

// Form Schema
const formSchema = z.object({
  name: z
    .string({
      required_error: "Tên cuộc trò chuyện không được trống",
    })
    .min(2, {
      message: "Tên cuộc trò chuyện phải nhiều hơn 2 ký tự",
    })
    .max(50, {
      message: "Tên cuộc trò chuyện không được quá 50 ký tự",
    }),
  desc: z.any(),
});

export function Chats({ defaultLayout = [364.5, 655] }: ChatsProps) {
  // User
  const user: any = useSession().data?.user;

  // Insert model open
  const [insMOpen, setInsMOpen] = useState<boolean>(false);

  // Insert model loading
  const [insertLoading, setInsertLoading] = useState<boolean>(false);

  // Draw open
  const [drawOpen, setDrawOpen] = useState<boolean>(false);

  // Hande set drower
  const handleSetDrawOpen = useCallback((open: boolean) => {
    setDrawOpen(open);
  }, []);

  // Delete model loading
  const [delMOpen, setDelMOpen] = useState<boolean>(false);

  // History hide
  const [isHisHide, setIsHisHide] = useState<boolean>(false);

  // Delete model loading
  const [deleteLoading, setDeleteLoading] = useState<boolean>(false);

  // Use chat
  const chats = useChats();

  // Current chat
  const currentChat = useCurrentChat();

  // Handle set hishide
  const handleSetHisHide = (open: boolean) => {
    // Set hishide
    if (open !== isHisHide) {
      setIsHisHide(open);
    }
  };

  // Handle Open
  const handleOpenInsMOpen = (open: boolean) => {
    // Set Open
    setInsMOpen(open);

    // Reset form
    if (open === false) formInsert.reset();
  };

  // Handle Open
  const handleOpenDelMOpen = (open: boolean) => setDelMOpen(open);

  // Define form.
  const formInsert = useForm<z.infer<typeof formSchema>>({
    resolver: zodResolver(formSchema),
    defaultValues: {
      name: "",
      desc: "",
    },
  });

  // On Submit
  const onInsert = (values: z.infer<typeof formSchema>) => {
    // Enable loading
    setInsertLoading(true);

    // Close model
    handleOpenInsMOpen(false);

    // Promise
    const promise = (): Promise<Conversations> =>
      new Promise(async (resolve, reject) =>
        setTimeout(async () => {
          // Response
          const res: Response = await fetcher({
            method: "POST",
            url: "/conversations/create",
            payload: {
              user_id: user._id,
              name: values.name,
              desc: values.desc,
            },
          });

          // Check status
          res?.ok ? resolve(res?.data) : reject(res?.detail);
        }, 1000),
      );

    // Toast
    toast.promise(promise, {
      loading: "Đang tạo cuộc trò chuyện mới, vui lòng đợi...",
      success: (result: Conversations) => {
        // Set message
        chats.set([...chats.get, result]);

        // Show message
        return "Tạo cuộc trò chuyện mới thành công";
      },
      error: (message: string[]) => errors(toast, message),
      finally: () => {
        // Reset form
        formInsert.reset();

        // Disable loading
        setInsertLoading(false);
      },
    });
  };

  // Delete All
  const onDeleteAll = (e: MouseEvent<HTMLButtonElement>) => {
    // Prevent default
    e.preventDefault();

    // Enable loading
    setDeleteLoading(true);

    // Check if there is a conversation
    if (chats.get.length > 0) {
      // Promise
      const promise = (): Promise<void> =>
        new Promise(async (resolve, reject) => {
          // Close model
          handleOpenDelMOpen(false);

          // Delay
          setTimeout(async () => {
            // Get all chats id
            const all = chats.get?.map((chat: any) => chat._id);

            // Sign In
            const res: Response = await fetcher({
              method: "PUT",
              url: "/conversations/soft_delete",
              payload: {
                ids: all,
                user_id: user._id,
              },
            });

            // Return
            return res?.ok ? resolve() : reject(res?.detail);
          }, 500);
        });

      // Toast
      toast.promise(promise, {
        loading: "Đang xoá tất cả các cuộc trò chuyện, vui lòng đợi...",
        success: () => {
          // Set conversation
          chats.set([]);

          // Set current chat
          currentChat.set(null);

          // Show message
          return "Xoá tất cả các cuộc trò chuyện thành công";
        },
        error: (message: string[]) => errors(toast, message),
        finally: () => {
          // Reset form
          formInsert.reset();

          // Disable loading
          setInsertLoading(false);

          // Enable loading
          setDeleteLoading(false);
        },
      });
    }
  };

  // Return
  return (
    <TooltipProvider delayDuration={0}>
      <ResizablePanelGroup
        direction="horizontal"
        onLayout={(sizes: number[]) => {
          document.cookie = `react-resizable-panels:layout=${JSON.stringify(sizes)}`;
        }}
        className="items-stretch h-full overflow-auto"
      >
        <ResizablePanel defaultSize={defaultLayout[0]} minSize={30}>
          <ChatDisplay
            setIsHisHide={handleSetHisHide}
            isHishide={isHisHide}
            setDrawOpen={setDrawOpen}
          />
        </ResizablePanel>
        <>
          <ResizableHandle withHandle className="max-lg:hidden" />
          <ResizablePanel
            defaultSize={defaultLayout[1]}
            maxSize={isHisHide ? 0 : 50}
            minSize={22}
            className="h-unset transition-all max-lg:hidden"
          >
            <div className="flex flex-col">
              <div className="flex items-center px-4 py-3 flex-nowrap">
                <h1 className="text-xl font-bold">Lịch sử trò chuyện</h1>
              </div>
              <Separator />
              {!chats?.loading ? (
                <>
                  <div className="h-full bg-background/95 p-4 backdrop-blur supports-[backdrop-filter]:bg-background/60">
                    <div className="flex justify-end gap-2">
                      <Dialog open={insMOpen} onOpenChange={handleOpenInsMOpen}>
                        <DialogTrigger asChild>
                          <Button
                            size="sm"
                            className="px-3 !py-1 flex gap-2 items-center"
                            disabled={insertLoading}
                          >
                            {insertLoading && <Spinner />}
                            <Trash2 size={15} />
                            <p className="text-[13px] mb-0 mt-[2px]">Thêm</p>
                          </Button>
                        </DialogTrigger>
                        <DialogContent className="sm:max-w-[425px]">
                          <DialogHeader>
                            <DialogTitle>Thêm cuộc trò chuyện</DialogTitle>
                            <DialogDescription>
                              Tạo một cuộc trò chuyện mới để trò chuyện với BOT!
                            </DialogDescription>
                          </DialogHeader>
                          <Separator />
                          <Form {...formInsert}>
                            <form
                              onSubmit={formInsert.handleSubmit(onInsert)}
                              className="grid gap-4 py-4"
                            >
                              <FormField
                                name="name"
                                render={({ field }) => (
                                  <FormItem>
                                    <FormLabel>Tên cuộc trò chuyện</FormLabel>
                                    <FormControl>
                                      <Input
                                        className="col-span-3"
                                        {...field}
                                        placeholder="Tên cuộc trò chuyện"
                                      />
                                    </FormControl>
                                    <FormMessage />
                                  </FormItem>
                                )}
                              />
                              <FormField
                                name="desc"
                                render={({ field }) => (
                                  <FormItem>
                                    <FormLabel>Mô tả</FormLabel>
                                    <FormControl>
                                      <Textarea
                                        className="col-span-3"
                                        {...field}
                                        placeholder="Mô tả cuộc trò chuyện"
                                      />
                                    </FormControl>
                                    <FormMessage />
                                  </FormItem>
                                )}
                              />
                              <Button type="submit" disabled={insertLoading}>
                                Thêm cuộc trò chuyện
                              </Button>
                            </form>
                          </Form>
                        </DialogContent>
                      </Dialog>
                      {chats.get?.length > 0 && (
                        <AlertDialog open={delMOpen} onOpenChange={handleOpenDelMOpen}>
                          <AlertDialogTrigger asChild>
                            <Button
                              size="sm"
                              variant="destructive"
                              disabled={deleteLoading}
                              className="px-3 !py-1 flex gap-2 items-center"
                            >
                              {deleteLoading && <Spinner />}
                              <Trash2 size={15} />
                              <p className="text-[13px] mb-0 mt-[2px]">Xoá tất cả</p>
                            </Button>
                          </AlertDialogTrigger>
                          <AlertDialogContent>
                            <AlertDialogHeader>
                              <AlertDialogTitle>
                                Bạn muốn xoá tất cả cuộc trò chuyện?
                              </AlertDialogTitle>
                              <AlertDialogDescription>
                                Bạn có chắc chắn muốn xoá tất cả cuộc trò chuyện, nội dung
                                tin nhắn cũng sẽ bị xoá.
                                <p className="text-red-500">
                                  Xoá tất cả sẽ không thể khôi phục lại!
                                </p>
                              </AlertDialogDescription>
                            </AlertDialogHeader>
                            <AlertDialogFooter>
                              <Button
                                variant="outline"
                                onClick={() => handleOpenDelMOpen(false)}
                              >
                                Huỷ
                              </Button>
                              <Button variant="destructive" onClick={onDeleteAll}>
                                Xoá tất cả
                              </Button>
                            </AlertDialogFooter>
                          </AlertDialogContent>
                        </AlertDialog>
                      )}
                    </div>
                  </div>
                  <ChatsList items={chats.get} />
                </>
              ) : (
                <div className="h-screen flex items-center justify-center">
                  <Spinner className="text-[#d9d9d99d] fill-blue-600 !h-8 !w-8" />
                </div>
              )}
            </div>
            <Drawer.Root direction="right" open={drawOpen} onOpenChange={setDrawOpen}>
              <Drawer.Portal>
                <Drawer.Overlay className="fixed inset-0 bg-black/40" />
                <Drawer.Content className="bg-white lg:hidden flex flex-col rounded-t-[10px] h-full w-full sm:w-[400px] mt-24 fixed bottom-0 right-0">
                  <div className="bg-white flex-1 h-full lg:hidden after::hidden">
                    <div className="flex flex-col">
                      <div className="flex items-center justify-between px-4 py-3 flex-nowrap">
                        <h1 className="text-xl font-bold">Lịch sử trò chuyện</h1>
                        <Button
                          size="icon"
                          variant="ghost"
                          onClick={() => setDrawOpen(false)}
                        >
                          <X className="h-5 w-5" />
                          <span className="sr-only">Lịch sử</span>
                        </Button>
                      </div>
                      <Separator />
                      {!chats?.loading ? (
                        <>
                          <div className="h-full bg-background/95 p-4 backdrop-blur supports-[backdrop-filter]:bg-background/60">
                            <div className="flex justify-end gap-2">
                              <Dialog open={insMOpen} onOpenChange={handleOpenInsMOpen}>
                                <DialogTrigger asChild>
                                  <Button
                                    size="sm"
                                    className="px-3 !py-1 flex gap-2 items-center"
                                    disabled={insertLoading}
                                  >
                                    {insertLoading && <Spinner />}
                                    <Trash2 size={15} />
                                    <p className="text-[13px] mb-0 mt-[2px]">Thêm</p>
                                  </Button>
                                </DialogTrigger>
                                <DialogContent className="sm:max-w-[425px]">
                                  <DialogHeader>
                                    <DialogTitle>Thêm cuộc trò chuyện</DialogTitle>
                                    <DialogDescription>
                                      Tạo một cuộc trò chuyện mới để trò chuyện với BOT!
                                    </DialogDescription>
                                  </DialogHeader>
                                  <Separator />
                                  <Form {...formInsert}>
                                    <form
                                      onSubmit={formInsert.handleSubmit(onInsert)}
                                      className="grid gap-4 py-4"
                                    >
                                      <FormField
                                        name="name"
                                        render={({ field }) => (
                                          <FormItem>
                                            <FormLabel>Tên cuộc trò chuyện</FormLabel>
                                            <FormControl>
                                              <Input
                                                className="col-span-3"
                                                {...field}
                                                placeholder="Tên cuộc trò chuyện"
                                              />
                                            </FormControl>
                                            <FormMessage />
                                          </FormItem>
                                        )}
                                      />
                                      <FormField
                                        name="desc"
                                        render={({ field }) => (
                                          <FormItem>
                                            <FormLabel>Mô tả</FormLabel>
                                            <FormControl>
                                              <Textarea
                                                className="col-span-3"
                                                {...field}
                                                placeholder="Mô tả cuộc trò chuyện"
                                              />
                                            </FormControl>
                                            <FormMessage />
                                          </FormItem>
                                        )}
                                      />
                                      <Button type="submit" disabled={insertLoading}>
                                        Thêm cuộc trò chuyện
                                      </Button>
                                    </form>
                                  </Form>
                                </DialogContent>
                              </Dialog>
                              {chats.get?.length > 0 && (
                                <AlertDialog
                                  open={delMOpen}
                                  onOpenChange={handleOpenDelMOpen}
                                >
                                  <AlertDialogTrigger asChild>
                                    <Button
                                      size="sm"
                                      variant="destructive"
                                      disabled={deleteLoading}
                                      className="px-3 !py-1 flex gap-2 items-center"
                                    >
                                      {deleteLoading && <Spinner />}
                                      <Trash2 size={15} />
                                      <p className="text-[13px] mb-0 mt-[2px]">
                                        Xoá tất cả
                                      </p>
                                    </Button>
                                  </AlertDialogTrigger>
                                  <AlertDialogContent>
                                    <AlertDialogHeader>
                                      <AlertDialogTitle>
                                        Bạn muốn xoá tất cả cuộc trò chuyện?
                                      </AlertDialogTitle>
                                      <AlertDialogDescription>
                                        Bạn có chắc chắn muốn xoá tất cả cuộc trò chuyện,
                                        nội dung tin nhắn cũng sẽ bị xoá.
                                        <p className="text-red-500">
                                          Xoá tất cả sẽ không thể khôi phục lại!
                                        </p>
                                      </AlertDialogDescription>
                                    </AlertDialogHeader>
                                    <AlertDialogFooter>
                                      <Button
                                        variant="outline"
                                        onClick={() => handleOpenDelMOpen(false)}
                                      >
                                        Huỷ
                                      </Button>
                                      <Button variant="destructive" onClick={onDeleteAll}>
                                        Xoá tất cả
                                      </Button>
                                    </AlertDialogFooter>
                                  </AlertDialogContent>
                                </AlertDialog>
                              )}
                            </div>
                          </div>
                          <ChatsList
                            items={chats.get}
                            isDrawer={true}
                            setDrawer={handleSetDrawOpen}
                          />
                        </>
                      ) : (
                        <div className="h-screen flex items-center justify-center">
                          <Spinner className="text-[#d9d9d99d] fill-blue-600 !h-8 !w-8" />
                        </div>
                      )}
                    </div>
                  </div>
                </Drawer.Content>
                <ChatsList
                  items={chats.get}
                  isDrawer={true}
                  setDrawer={handleSetDrawOpen}
                />
              </Drawer.Portal>
            </Drawer.Root>
          </ResizablePanel>
        </>
      </ResizablePanelGroup>
    </TooltipProvider>
  );
}

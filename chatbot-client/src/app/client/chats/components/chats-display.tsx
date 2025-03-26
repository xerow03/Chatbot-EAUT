"use client";
import { format } from "date-fns";
import {
  Archive,
  ArchiveX,
  History,
  MoreVertical,
  Reply,
  RotateCcw,
  Trash2,
} from "lucide-react";
import {
  DropdownMenuCheckboxItem,
  DropdownMenuContent,
  DropdownMenuLabel,
  DropdownMenuSeparator,
} from "@/components/ui/dropdown-menu";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Button } from "@/components/ui/button";
import { DropdownMenu, DropdownMenuTrigger } from "@/components/ui/dropdown-menu";
import { Label } from "@/components/ui/label";
import { Separator } from "@/components/ui/separator";
import { Switch } from "@/components/ui/switch";
import { Textarea } from "@/components/ui/textarea";
import { Tooltip, TooltipContent, TooltipTrigger } from "@/components/ui/tooltip";
import {
  Dispatch,
  FormEvent,
  SetStateAction,
  useCallback,
  useEffect,
  useState,
} from "react";
import { useCurrentChat, useSocket, useChats } from "@/app/client/hooks/use-chats";
import Messages from "@/app/common/types/interface/Messages";
import { fetcher } from "@/app/common/utils/fetcher";
import ChatContent from "./chat-content";
import { toast } from "sonner";
import Empty from "@/components/ui/empty";
import Conversations from "@/app/common/types/interface/Conversations";
import { useSession } from "next-auth/react";
import { errors } from "@/app/common/utils/ultils";
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
import DotLoading from "@/components/custom/loading/dot/dot.loading";
type Props = {
  isHishide: boolean;
  setIsHisHide: Function;
  setDrawOpen: Dispatch<SetStateAction<boolean>>;
};

export function ChatDisplay({ isHishide, setIsHisHide, setDrawOpen }: Props) {
  // Reload
  const [reload, setReload] = useState<boolean>(false);

  // Input
  const [input, setInput] = useState<string>("");

  // Current chat
  const currentChat = useCurrentChat();

  // Message list state
  const [messagesList, setMessagesList] = useState<Messages[]>([]);

  // Delete model loading
  const [deleteLoading, setDeleteLoading] = useState<boolean>(false);

  // Is reply
  const [isReply, setIsReply] = useState<boolean>();

  // Loading chat
  const [isLoadingChat, setIsLoadingChat] = useState<boolean>(true);

  // Handle set hishide
  const [openDelMOpen, setDelMOpen] = useState<boolean>(false);

  // Handle Open
  const handleOpenDelMOpen = (open: boolean) => setDelMOpen(open);

  // Use chat
  const chats = useChats();

  // Socket
  const socket: WebSocket = useSocket();

  // Reloading
  const reloading = () => setReload((prev) => !prev);

  // User
  const user: any = useSession().data?.user;

  // Not run
  const not_run = () => {
    toast.warning("Chức năng này hiện chưa hoạt động");
  };

  // Handle Set Input
  const handleSetInput = (value: string) => setInput(value);

  const onFinish = async (event: FormEvent): Promise<void> => {
    // Prevent
    event.preventDefault();

    // Check input is valid
    if (input) {
      // Check current chat
      if (currentChat.get?._id) {
        // Enable is reply
        setIsReply(true);

        // Send
        const send = {
          sender: "USER",
          message: input,
          conversation: currentChat.get?._id,
        };

        // Add message
        setMessagesList((prev: Messages[]) => [
          {
            ...send,
            send_at: format(new Date(), "yyyy-MM-dd HH:mm:ss"),
          },
          ...prev,
        ]);

        // Send Message
        socket.send(JSON.stringify(send));
      } else {
        // Show message error
        toast.error("Vui lòng chọn một cuộc hội thoại, hoặc tạo nếu chưa có");
      }

      // Reset input
      setInput("");
    } else {
      // Show message error
      toast.error("Vui lòng nhập nội dung tin nhắn");
    }
  };

  // On delete one
  const onDeleteOne = useCallback(
    async () => {
      // Close dialog
      handleOpenDelMOpen(false);

      // Promise
      const promise = (): Promise<void> =>
        new Promise(async (resolve, reject) => {
          // Enable loading
          setDeleteLoading(true);

          // Sign In
          const res: any = await fetcher({
            method: "PUT",
            url: "/conversations/soft_delete",
            payload: {
              ids: [currentChat.get?._id],
              user_id: user._id,
            },
          });

          // Return
          return res?.ok ? resolve() : reject(res?.error);
        });

      // Loading
      toast.promise(promise, {
        loading: "Xoá cuộc trò chuyện đã chọn",
        success: () => {
          // Filter data
          const updated = chats.get?.filter(
            (item: Conversations) => item?._id !== currentChat.get?._id,
          );

          // Update state
          chats.set(updated);

          // Change current chat
          currentChat.set(null);

          // Show message
          return "Xoá cuộc trò chuyện thành công";
        },
        error: (message: string[]) => errors(toast, message),
        finally: () => {
          // Disable loading
          setDeleteLoading(false);
        },
      });
    },
    // eslint-disable-next-line react-hooks/exhaustive-deps
    [chats.get, currentChat.get, user?._id],
  );

  // Resend
  const onResend = () => {
    // Check message lenngth
    if (messagesList?.length >= 2) {
      // Check current chat
      if (currentChat.get?._id) {
        // Enable is reply
        setIsReply(true);

        // Message length
        const mesLen = messagesList?.length;

        // Send
        const send = {
          sender: "USER",
          message: messagesList[mesLen - 1].message,
          conversation: currentChat.get?._id,
        };

        // Add message
        setMessagesList((prev: Messages[]) => [
          {
            ...send,
            send_at: format(new Date(), "yyyy-MM-dd HH:mm:ss"),
          },
          ...prev,
        ]);

        // Send Message
        socket.send(JSON.stringify(send));
      } else {
        // Show message error
        toast.error("Vui lòng chọn một cuộc hội thoại, hoặc tạo nếu chưa có");
      }

      // Reset input
      setInput("");
    } else {
      // Error message
      toast.error("Không có câu hỏi để gửi lại");
    }
  };

  // Socket Effect
  useEffect(() => {
    // Check socket connected
    if (socket) {
      // Subscribes events
      socket.onmessage = (ev: MessageEvent) => {
        // Check ev is valid
        if (ev?.data) {
          // Disable is reply
          setIsReply(false);

          // Mes
          const mes = JSON.parse(ev.data);

          // Set message
          setMessagesList((prev) => [mes, ...prev]);
        }
      };
    }
  }, [socket]);

  // Use Effect
  useEffect(() => {
    // Caling
    currentChat.get?._id &&
      (async () => {
        // Enable loading
        setIsLoadingChat(true);

        // Get messages
        const res: any = await fetcher({
          method: "GET",
          url: "/messages/page",
          payload: { cvs_id: currentChat.get._id, page: 0 },
        });

        // Check status
        if (res?.ok) setMessagesList(res?.data);

        // Disable loading with end request
        if (res?.status !== null) setIsLoadingChat(false);
      })();

    // Return clean
    return () => {
      setMessagesList([]);
    };

    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [currentChat.get?._id, reload]);

  // Return
  return (
    <div className="flex flex-col overflow-hidden h-screen w-full">
      <div className="flex items-center p-2">
        <div className="flex items-center gap-2">
          <Tooltip>
            <TooltipTrigger asChild>
              <Button variant="ghost" size="icon" onClick={not_run}>
                <Archive className="h-4 w-4" />
                <span className="sr-only">Ghim</span>
              </Button>
            </TooltipTrigger>
            <TooltipContent>Ghim</TooltipContent>
          </Tooltip>
          <Tooltip>
            <TooltipTrigger asChild>
              <Button variant="ghost" size="icon" onClick={not_run}>
                <ArchiveX className="h-4 w-4" />
                <span className="sr-only">Xoá ghim</span>
              </Button>
            </TooltipTrigger>
            <TooltipContent>Xoá ghim</TooltipContent>
          </Tooltip>
          <Separator orientation="vertical" className="mx-1 h-6" />
          <AlertDialog open={openDelMOpen} onOpenChange={handleOpenDelMOpen}>
            <AlertDialogTrigger asChild>
              <div>
                <Tooltip>
                  <TooltipTrigger asChild>
                    <Button
                      size="icon"
                      variant="ghost"
                      disabled={
                        currentChat?.get?._id
                          ? isLoadingChat
                            ? true
                            : isReply
                            ? true
                            : deleteLoading
                          : true
                      }
                      onClick={() => handleOpenDelMOpen(true)}
                    >
                      <Trash2 className="h-4 w-4" />
                      <span className="sr-only">Xoá cuộc trò chuyện</span>
                    </Button>
                  </TooltipTrigger>
                  <TooltipContent>Xoá cuộc trò chuyện</TooltipContent>
                </Tooltip>
              </div>
            </AlertDialogTrigger>
            <AlertDialogContent>
              <AlertDialogHeader>
                <AlertDialogTitle>Bạn muốn xoá cuộc trò chuyện?</AlertDialogTitle>
                <AlertDialogDescription>
                  Bạn có chắc chắn muốn xoá cuộc trò chuyện này, nội dung tin nhắn cũng sẽ
                  bị xoá.
                  <p className="text-red-500">
                    Xoá cuộc trò chuyện sẽ không thể khôi phục lại!
                  </p>
                </AlertDialogDescription>
              </AlertDialogHeader>
              <AlertDialogFooter>
                <Button variant="outline" onClick={() => handleOpenDelMOpen(false)}>
                  Huỷ
                </Button>
                <Button variant="destructive" onClick={onDeleteOne}>
                  Xoá
                </Button>
              </AlertDialogFooter>
            </AlertDialogContent>
          </AlertDialog>
        </div>
        <div className="ml-auto flex items-center gap-2">
          <Tooltip>
            <TooltipTrigger asChild>
              <Button
                variant="ghost"
                size="icon"
                onClick={onResend}
                disabled={
                  currentChat?.get?._id
                    ? isLoadingChat
                      ? true
                      : deleteLoading
                      ? true
                      : isReply
                    : true
                }
              >
                <Reply className="h-4 w-4" />
                <span className="sr-only">Reply</span>
              </Button>
            </TooltipTrigger>
            <TooltipContent>Gửi lại câu hỏi trước</TooltipContent>
          </Tooltip>
          <Tooltip>
            <TooltipTrigger asChild>
              <Button
                variant="ghost"
                size="icon"
                onClick={reloading}
                disabled={
                  currentChat?.get?._id
                    ? isLoadingChat
                      ? true
                      : (deleteLoading ? true : isReply) ||
                        (isReply ? true : deleteLoading)
                    : true
                }
              >
                <RotateCcw className="h-[13px] w-[13px] mt-[3px]" />
                <span className="sr-only">Tải lại cuộc trò chuyện</span>
              </Button>
            </TooltipTrigger>
            <TooltipContent>Tải lại cuộc trò chuyện</TooltipContent>
          </Tooltip>
        </div>
        <Separator orientation="vertical" className="mx-2 h-6" />
        <Tooltip>
          <TooltipTrigger asChild>
            <Button
              variant="ghost"
              onClick={() => setDrawOpen(true)}
              size="icon"
              className="lg:hidden"
            >
              <History className="h-4 w-4" />
              <span className="sr-only">Lịch sử</span>
            </Button>
          </TooltipTrigger>
          <TooltipContent>Lịch sử trò chuyện</TooltipContent>
        </Tooltip>
        <DropdownMenu>
          <DropdownMenuTrigger asChild>
            <Button variant="ghost" size="icon" className="max-lg:hidden">
              <MoreVertical className="h-4 w-4" />
              <span className="sr-only">More</span>
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end">
            <DropdownMenuLabel>Lịch sử trò chuyện</DropdownMenuLabel>
            <DropdownMenuSeparator />
            <DropdownMenuCheckboxItem
              checked={isHishide === false}
              onCheckedChange={() => setIsHisHide(false)}
            >
              Hiển thị lịch sử trò chuyện
            </DropdownMenuCheckboxItem>
            <DropdownMenuCheckboxItem
              checked={isHishide === true}
              onCheckedChange={() => setIsHisHide(true)}
            >
              Ẩn lịch sử trò chuyện
            </DropdownMenuCheckboxItem>
          </DropdownMenuContent>
        </DropdownMenu>
      </div>
      <Separator />
      {currentChat?.get?._id ? (
        <>
          {!isLoadingChat ? (
            <div className="flex flex-1 flex-col h-[calc(100vh-52px)]">
              <div className="flex items-start p-4">
                <div className="flex items-start gap-4 text-sm">
                  <Avatar>
                    <AvatarImage alt="Chatbot" src="/images/logo-bot.jpg" />
                    <AvatarFallback>EAUT</AvatarFallback>
                  </Avatar>
                  <div className="grid gap-1">
                    <div className="font-semibold">EAUT CHATBOT</div>
                    <div className="line-clamp-1 text-xs">
                      Cuộc trò chuyện với EAUT CHATBOT
                    </div>
                  </div>
                </div>
                {currentChat.get?.created_at && (
                  <div className="ml-auto text-xs text-muted-foreground">
                    {format(new Date(currentChat.get.created_at), "dd/MM/yyyy")}
                  </div>
                )}
              </div>
              <Separator />
              <div
                className={`${
                  messagesList?.length > 0 ? "overflow-auto" : "overflow-hidden"
                } flex-1 whitespace-pre-wrap p-4 text-sm`}
              >
                {messagesList?.length > 0 ? (
                  <ChatContent
                    mes={messagesList}
                    cvsId={currentChat.get?._id}
                    setMes={setMessagesList}
                  />
                ) : (
                  <div className="h-full">
                    <Empty desc="Không có tin nhắn nào" />
                  </div>
                )}
              </div>
              <Separator />
              <div className="p-4">
                <form>
                  <div className="grid gap-4">
                    <Textarea
                      className="p-4"
                      value={input}
                      onChange={(e) => handleSetInput(e.target.value)}
                      onKeyDown={(e) => {
                        if (e.key === "Enter" && !e.shiftKey) onFinish(e);
                      }}
                      placeholder="Trò chuyện với EAUT CHATBOT..."
                    />
                    <div className="flex items-center">
                      <div className="flex item-center gap-5">
                        <Label
                          htmlFor="mute"
                          className="flex items-center gap-2 text-xs font-normal"
                        >
                          <Switch id="mute" aria-label="Mute thread" />
                        </Label>
                        {isReply && (
                          <div className="flex gap-2 items-center">
                            <DotLoading />
                            <p className="text-[13px]">Bot đang trả lời</p>
                          </div>
                        )}
                      </div>
                      <Button onClick={onFinish} size="sm" className="ml-auto">
                        Gửi tin nhắn
                      </Button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          ) : (
            <div className="h-full flex items-center justify-center">
              <Spinner className="text-[#d9d9d99d] fill-blue-600 !h-8 !w-8" />
            </div>
          )}
        </>
      ) : (
        <div className="h-full">
          <Empty desc="Không có cuộc hội thoại nào được chọn" />
        </div>
      )}
    </div>
  );
}

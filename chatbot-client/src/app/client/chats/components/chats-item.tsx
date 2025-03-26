"use client";
import type Conversations from "@/app/common/types/interface/Conversations";
import { Button } from "@/components/ui/button";
import { cn } from "@/lib/utils";
import { formatDistanceToNow, format } from "date-fns";
import { useState, MouseEvent, useCallback } from "react";
import { toast } from "sonner";
import { useChats, useCurrentChat } from "@/app/client/hooks/use-chats";
import { vi } from "date-fns/locale";
import { Badge } from "@/components/ui/badge";
import { fetcher } from "@/app/common/utils/fetcher";
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
import { Tooltip, TooltipContent, TooltipTrigger } from "@/components/ui/tooltip";

type Props = {
  item: Conversations;
  isDrawer?: boolean;
  setDrawer?: Function;
};

export default function ChatsItem({ item, isDrawer, setDrawer }: Props) {
  // Focus state
  const [focused, setFocused] = useState<boolean>(false);

  // Delete model loading
  const [deleteLoading, setDeleteLoading] = useState<boolean>(false);

  // Handle set hishide
  const [openDelMOpen, setDelMOpen] = useState<boolean>(false);

  // Handle Open
  const handleOpenDelMOpen = (open: boolean) => setDelMOpen(open);

  // User
  const user: any = useSession().data?.user;

  // Use chat
  const chats = useChats();

  // Current chat
  const currentChat = useCurrentChat();

  // On Mouse Enter
  const onMouseEnter = (e: MouseEvent<HTMLDivElement>) => {
    // Stop Default
    e.preventDefault();

    // Set Focus
    setFocused(true);
  };

  // On Mouse Leave
  const onMouseLeave = (e: MouseEvent<HTMLDivElement>) => {
    // Stop Default
    e.preventDefault();

    // Set Focus
    setFocused(false);
  };

  // On Set Conversation
  const onSetConversation = (cvs: Conversations) => {
    // Check if conversation is already selected
    if (currentChat.get?._id !== cvs._id) {
      // Set conversation
      currentChat.set(item);

      // Close drawer
      if (isDrawer && setDrawer) setDrawer(false);
    }
  };

  // On delete one
  const onDeleteOne = useCallback(
    async (e: MouseEvent<HTMLButtonElement>, cvs: Conversations) => {
      // Stop Default
      e.preventDefault();

      // Stop Propagation
      e.stopPropagation();

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
              ids: [cvs?._id],
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
            (item: Conversations) => item?._id !== cvs?._id,
          );

          // Update state
          chats.set(updated);

          // Current chat is delete
          if (currentChat.get?._id === cvs?._id) {
            // Change current chat
            currentChat.set(null);
          }

          // Show message
          return "Xoá cuộc trò chuyện thành công";
        },
        error: (message: string[]) => errors(toast, message),
        finally: () => {
          // Disable loading
          setDeleteLoading(false);

          // Close drawer
          if (isDrawer && setDrawer) setDrawer(false);
        },
      });
    },
    // eslint-disable-next-line react-hooks/exhaustive-deps
    [chats.get, currentChat.get, user._id],
  );

  // Return
  return (
    <div
      onMouseLeave={onMouseLeave}
      onMouseEnter={onMouseEnter}
      key={item._id}
      className={cn(
        "cursor-pointer h-[136px] flex flex-col items-start gap-2 rounded-lg border p-3 text-left text-sm transition-all hover:bg-accent",
        currentChat.get?._id === item?._id && "bg-muted",
      )}
      onClick={() => onSetConversation(item)}
    >
      <div className="flex w-full flex-col gap-1">
        <div className="flex items-center">
          <div className="flex items-center gap-2">
            <div className="font-semibold">{item.name}</div>
          </div>
          <div
            className={cn(
              "ml-auto text-xs",
              currentChat.get?._id === item?._id
                ? "text-foreground"
                : "text-muted-foreground",
            )}
          >
            {item?.last_message?.send_at &&
              formatDistanceToNow(new Date(item?.last_message?.send_at), {
                addSuffix: true,
                locale: vi,
              })}
          </div>
        </div>
        <div className="text-xs font-medium">
          Ngày tạo {format(new Date(item.created_at), "dd/MM/yyyy")}
        </div>
      </div>
      <div className="flex-1 line-clamp-2 text-xs text-muted-foreground">
        {item?.last_message?._id
          ? item?.last_message?.message?.substring(0, 300)
          : "Không có tin nhắn nào trong cuộc trò chuyền"}
      </div>
      <div className="flex justify-between w-full relative">
        <div className="flex items-center gap-2">
          <Badge variant="default">chatbot</Badge>
        </div>
        {focused && (
          <div className="text-xs text-muted-foreground absolute right-0 bottom-0">
            <AlertDialog open={openDelMOpen} onOpenChange={handleOpenDelMOpen}>
              <AlertDialogTrigger asChild>
                <Tooltip>
                  <TooltipTrigger asChild>
                    <Button
                      size="xs"
                      variant="destructive"
                      disabled={deleteLoading}
                      onClick={() => handleOpenDelMOpen(true)}
                    >
                      Xoá
                    </Button>
                  </TooltipTrigger>
                  <TooltipContent>Xoá cuộc trò chuyện</TooltipContent>
                </Tooltip>
              </AlertDialogTrigger>
              <AlertDialogContent>
                <AlertDialogHeader>
                  <AlertDialogTitle>Bạn muốn xoá cuộc trò chuyện?</AlertDialogTitle>
                  <AlertDialogDescription>
                    Bạn có chắc chắn muốn xoá cuộc trò chuyện này, nội dung tin nhắn cũng
                    sẽ bị xoá.
                    <p className="text-red-500">
                      Xoá cuộc trò chuyện sẽ không thể khôi phục lại!
                    </p>
                  </AlertDialogDescription>
                </AlertDialogHeader>
                <AlertDialogFooter>
                  <Button variant="outline" onClick={() => handleOpenDelMOpen(false)}>
                    Huỷ
                  </Button>
                  <Button variant="destructive" onClick={(e) => onDeleteOne(e, item)}>
                    Xoá
                  </Button>
                </AlertDialogFooter>
              </AlertDialogContent>
            </AlertDialog>
          </div>
        )}
      </div>
    </div>
  );
}

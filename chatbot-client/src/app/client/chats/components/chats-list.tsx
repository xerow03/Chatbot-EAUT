"use client";
import { ScrollArea } from "@/components/ui/scroll-area";
import ChatsItem from "@/app/client/chats/components/chats-item";
import type Conversations from "@/app/common/types/interface/Conversations";
import Empty from "@/components/ui/empty";

interface ChatsListProps {
  items: Conversations[];
  isDrawer?: boolean;
  setDrawer?: Function;
}

export function ChatsList({ items, isDrawer, setDrawer }: ChatsListProps) {
  // Return
  return (
    <>
      {items.length > 0 ? (
        <ScrollArea className="h-[calc(100vh-136px)]">
          <div className="flex flex-col gap-2 p-4 pt-0">
            {items?.map((item: Conversations) => (
              <ChatsItem key={item._id} item={item} isDrawer={isDrawer} setDrawer={setDrawer} />
            ))}
          </div>
        </ScrollArea>
      ) : (
        <div className="h-[calc(100vh-136px)] flex items-center justify-center">
          <Empty desc="Không có cuộc trò chuyện nào" />
        </div>
      )}
    </>
  );
}

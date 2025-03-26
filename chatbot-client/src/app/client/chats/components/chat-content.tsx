"use client";
import Messages from "@/app/common/types/interface/Messages";
import InfiniteScroll from "react-infinite-scroll-component";
import { Dispatch, Fragment, SetStateAction, useState } from "react";
import { fetcher } from "@/app/common/utils/fetcher";
import { useSession } from "next-auth/react";
import { Response } from "@/app/common/types/res/response.type";
import { useCurrentChat } from "../../hooks/use-chats";
import Empty from "@/components/ui/empty";
import ChatLine from "./chat-line";

interface ChatContentProps {
  mes: Messages[];
  cvsId: string;
  setMes: Dispatch<SetStateAction<Messages[]>>;
}

export default function ChatContent({ mes, cvsId, setMes }: ChatContentProps) {
  // Page
  const [page, setPage] = useState<number>(0);

  // Is has more
  const [hasMore, setHasMore] = useState<boolean>(true);

  // User
  const user: any = useSession().data?.user;

  // Current chat
  const currentChat = useCurrentChat();

  const next = async () => {
    // Get messages
    const res: Response = await fetcher({
      method: "GET",
      url: "/messages/page",
      payload: { cvs_id: currentChat?._id, page: page + 1 },
    });

    // Check status
    if (res?.ok) {
      // Data
      const data = res?.data;

      // Check end messsage
      if (data?.length === 0) setHasMore(false);

      // Set page
      setPage(page + 1);

      // Set messages
      setMes(mes.concat(res?.data));
    }
  };

  // Return
  return (
    <div className="flex flex-1 overflow-auto py-3">
      {mes?.length > 0 ? (
        <div
          className="flex flex-1 overflow-y-auto flex-col-reverse py-0 scroll-smooth"
          id="scrollableDiv"
        >
          <InfiniteScroll
            next={next}
            inverse={true}
            hasMore={hasMore}
            dataLength={mes.length}
            scrollableTarget="scrollableDiv"
            loader={<Fragment />}
            className="flex overflow-y-auto flex-col-reverse scroll-smooth gap-5"
          >
            {mes?.map((msg: any, index: number) => (
              <ChatLine user={user} key={index} data={msg} />
            ))}
          </InfiniteScroll>
        </div>
      ) : (
        <div className="flex flex-1 items-center justify-center">
          <Empty desc="Không có tin nhắn nào" />
        </div>
      )}
    </div>
  );
}

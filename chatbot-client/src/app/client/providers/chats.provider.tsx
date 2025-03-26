"use client";
import { FC, ReactNode, useEffect, useState } from "react";
import { createContext } from "react";
import { Response } from "@/app/common/types/res/response.type";
import { fetcher, HOST, PORT } from "@/app/common/utils/fetcher";
import { useSession } from "next-auth/react";
type Props = {
  children: ReactNode;
};

// App Context
export const ChatsContext = createContext(null);

const ChatsProvider: FC<Props> = ({ children }: Props) => {
  // Chats state
  const [chats, setChats] = useState<any>([]);

  // Current chat state
  const [current, setCurrent] = useState<any>([]);

  // User Data
  const user: any = useSession().data?.user;

  // Loading History
  const [isLoadingHistory, setIsLoadingHistory] = useState<boolean>(true);

  // Socket
  const [socket, setSocket] = useState<WebSocket | null>(null);

  // Disconnect socket
  const disconnect = () => {
    // Close socket
    socket?.close();

    // Clean
    setSocket(null);
  };

  // Use Effect Chats
  useEffect(() => {
    // Check user
    if (user?._id) {
      // Websocket
      const ws = new WebSocket(`ws://${HOST}:${PORT}/ws/${user?._id}`);

      // Set Client
      setSocket(ws);
    } else {
      // Disconnect Socket
      disconnect();
    }

    // Anonymous Chats
    user?._id &&
      (async () => {

        // Response
        const res: Response = await fetcher({
          method: "GET",
          url: "/conversations/page",
          payload: {
            page: 0,
            user_id: user?._id,
          },
        });

        // Check status
        if (res?.ok) {
          // Data
          const data = res?.data;

          // Checl data length
          if (data?.length > 0) {
            // Set Chats
            setChats(data);

            // Set Current
            setCurrent(data[0]);
          }
        }

        // Set loading
        if(res?.ok !== null) setIsLoadingHistory(false);
      })();
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [user?._id]);

  // Shared
  const shared: any = {
    list: {
      get: chats,
      set: setChats,
      loading: isLoadingHistory,
      setIsLoading: setIsLoadingHistory 
    },
    cur: {
      get: current,
      set: setCurrent,
    },
    socket: { get: socket },
  };
  // Return
  return <ChatsContext.Provider value={shared}>{children}</ChatsContext.Provider>;
};

export default ChatsProvider;

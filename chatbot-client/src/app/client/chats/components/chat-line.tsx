"use client";
import { SenderEnum } from "@/app/common/enum/sender.enum";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { formatDate } from "date-fns";
import React, { memo } from "react";

type Props = { data: any; user: any };

type TextMessage = {
  msg: string;
  isSender: boolean;
};

const MessageText: React.FC<any> = ({ isSender, msg }: TextMessage) => {
  // Color
  const colors: string = isSender ? "primary" : "white";

  // Return
  return (
    <div
      className={`
        ${isSender ? "bg-primary" : "bg-[#fafafaf8]"}
        min-h-[32px] rounded-[5px] 
        py-[8px] px-[13px] position-relative 
        border-[0.2px] border-${colors} text-[14px]`}
    >
      {isSender ? (
        <p className="m-0 text-white">{msg}</p>
      ) : (
        <p className="text-black m-0">{msg}</p>
      )}
    </div>
  );
};

const ChatLine: React.FC<Props> = ({ data, user }: Props) => {
  // Check sender
  const isSender = data?.sender === SenderEnum.USER;

  const justify = isSender ? "justify-end" : "justify-start";

  // Return
  return (
    <div className="grid">
      <div>
        <div className={`flex items-center ${justify}`}>
          <div className="flex items-start gap-3">
            <div className={`${isSender ? "order-3" : "order-1"}`}>
              <Avatar>
                <AvatarImage
                  alt={isSender ? user?.firstname?.charAt(0) : "EAUT"}
                  src={isSender ? "" : "/images/logo-bot.jpg"}
                />
                <AvatarFallback>
                  {isSender ? user?.firstname?.charAt(0) : "EAUT"}
                </AvatarFallback>
              </Avatar>
            </div>
            <div className="flex flex-col order-2 gap-1">
              <div className={`gap-2 flex items-center ${justify}`}>
                <p className="order-2 text-[10px] m-0">
                  {formatDate(data.send_at, "HH:mm")}
                </p>
                <p
                  className={`text-[12.5px] m-0 ${
                    isSender ? "order-3" : "order-1"
                  } font-bold`}
                >
                  {isSender ? `${user?.firstname} ${user?.lastname}` : "EAUT"}
                </p>
              </div>
              <div className={`flex ${justify}`}>
                <MessageText isSender={isSender} msg={data?.message} />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default memo(ChatLine);

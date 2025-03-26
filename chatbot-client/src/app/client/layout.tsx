"use client";
import { Separator } from "@/components/ui/separator";
import { Nav } from "./chats/components/nav";
import { Bot } from "lucide-react";
import { ReactNode } from "react";
import { TooltipProvider } from "@/components/ui/tooltip";

type Props = {
  children: ReactNode;
};

export default function ClientLayout({ children }: Props) {
  // Return
  return (
    <div className="flex">
      <TooltipProvider delayDuration={0}>
        <div className="w-[53px] border-r">
          <div className="flex h-[52px] items-center justify-center">
            <Bot size={30} color="royalblue" />
          </div>
          <Separator />
          <Nav />
        </div>
      </TooltipProvider>
      <div className="flex-1 w-full">{children}</div>
    </div>
  );
}

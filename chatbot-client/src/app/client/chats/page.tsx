import { cookies } from "next/headers";
import { Chats } from "@/app/client/chats/components/chats";
import ChatsProvider from "@/app/client/providers/chats.provider";

export default function ChatsPage() {
  const layout = cookies().get("react-resizable-panels:layout");

  // Default Layout
  const defaultLayout = layout ? JSON.parse(layout.value) : undefined;

  return (
    <div className="flex-col md:flex">
      <ChatsProvider>
        <Chats defaultLayout={defaultLayout} />
      </ChatsProvider>
    </div>
  );
}

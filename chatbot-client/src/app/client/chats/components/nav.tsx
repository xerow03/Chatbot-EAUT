"use client";
import Link from "next/link";
import {
  Inbox,
  Trash2,
  LucideIcon,
  Archive,
  LogOut,
} from "lucide-react";
import { cn } from "@/lib/utils";
import { Button, buttonVariants } from "@/components/ui/button";
import { Tooltip, TooltipContent, TooltipTrigger } from "@/components/ui/tooltip";
import { Separator } from "@/components/ui/separator";
import { signOut } from "next-auth/react";
import { errors } from "@/app/common/utils/ultils";
import { toast } from "sonner";
import { useState } from "react";

interface NavLinksProps {
  title: string;
  label?: string;
  icon: LucideIcon;
  variant: "default" | "ghost";
  link?: string;
}

const links: NavLinksProps[] = [
  {
    title: "Trò chuyện",
    label: "128",
    icon: Inbox,
    variant: "default",
    link: "/client/chats",
  },
  {
    title: "Thùng rác",
    label: "",
    icon: Trash2,
    variant: "ghost",
  },
  {
    title: "Ghim",
    label: "",
    icon: Archive,
    variant: "ghost",
  },
];

export function Nav() {
  // Logout loading
  const [logoutLoading, setLogoutLoading] = useState<boolean>(false);

  // Not run
  const not_run = () => {
    toast.warning("Chức năng này hiện chưa hoạt động");
  };

  // Handle logout
  const logout = () => {
    // Enable loading
    setLogoutLoading(true);

    // Promise
    const promise = (): Promise<void> =>
      new Promise(async (resolve, reject) =>
        setTimeout(async () => {
          resolve(await signOut({ callbackUrl: "/auth/login" }));
        }, 1000),
      );

    // Toast
    toast.promise(promise, {
      loading: "Đang đăng xuất, vui lòng đợi...",
      success: () => {
        // Show message
        return "Đăng xuất thành công";
      },
      error: (message: string[]) => errors(toast, message),
      finally: () => {
        // Disable loading
        setLogoutLoading(false);
      },
    });
  };

  // Return
  return (
    <div className="group flex flex-col gap-4 py-2">
      <nav className="grid gap-1 justify-between px-2">
        <div>
          {links.map((link, index) => (
            <Tooltip key={index} delayDuration={0}>
              <TooltipTrigger asChild>
                {link?.link ? (
                  <Link
                    href={link.link}
                    className={cn(
                      buttonVariants({ variant: link.variant, size: "icon" }),
                      "h-9 w-9",
                      link.variant === "default" &&
                        "dark:bg-muted dark:text-muted-foreground dark:hover:bg-muted dark:hover:text-white",
                    )}
                  >
                    <link.icon className="h-4 w-4" />
                    <span className="sr-only">{link.title}</span>
                  </Link>
                ) : (
                  <span
                    onClick={not_run}
                    className={cn(
                      buttonVariants({ variant: link.variant, size: "icon" }),
                      "h-9 w-9 cursor-pointer",
                      link.variant === "default" &&
                        "dark:bg-muted dark:text-muted-foreground dark:hover:bg-muted dark:hover:text-white",
                    )}
                  >
                    <link.icon className="h-4 w-4" />
                    <span className="sr-only">{link.title}</span>
                  </span>
                )}
              </TooltipTrigger>
              <TooltipContent side="right" className="flex items-center gap-4">
                {link.title}
              </TooltipContent>
            </Tooltip>
          ))}
        </div>
        <div className="h-px w-full bg-muted">
          <Separator />
          <Tooltip>
            <TooltipTrigger asChild>
              <Button
                size="icon"
                variant="ghost"
                disabled={logoutLoading}
                onClick={logout}
                className="h-9 w-9 dark:bg-muted dark:text-muted-foreground dark:hover:bg-muted dark:hover:text-white"
              >
                <LogOut className="h-4 w-4" />
                <span className="sr-only">Đăng xuất</span>
              </Button>
            </TooltipTrigger>
            <TooltipContent side="right" className="flex items-center gap-4">
              Đăng xuất
            </TooltipContent>
          </Tooltip>
        </div>
      </nav>
    </div>
  );
}

import type { Metadata } from "next";
import "@/app/common/styles/globals.css";
import { Nunito as FontSans } from "next/font/google";
import { cn } from "@/lib/utils";
import SessionProvider from "@/app/common/providers/session.providers";
import AppProgress from "@/components/custom/app.progress";
import { ThemeProvider } from "@/components/theme/theme.providers";
import { Toaster } from "sonner";

const fontSans = FontSans({
  subsets: ["latin"],
  variable: "--font-sans",
});

export const metadata: Metadata = {
  title: "Chatbot",
  description: "Chatbot EAUT Đại Học Công Nghệ Đông Á",
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en" suppressHydrationWarning>
      <body
        className={cn(
          "min-h-screen bg-background font-sans antialiased overflow-hidden",
          fontSans.variable,
        )}
      >
        <SessionProvider>
          <ThemeProvider attribute="class" defaultTheme="light">
            <Toaster position="top-center" richColors duration={2000} />
            <AppProgress />
            {children}
          </ThemeProvider>
        </SessionProvider>
      </body>
    </html>
  );
}

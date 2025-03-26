"use client";
import Link from "next/link";
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from "@/components/ui/form";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { z } from "zod";
import { ReadonlyURLSearchParams, useSearchParams } from "next/navigation";
import { useRouter } from "next-nprogress-bar";
import { toast } from "sonner";
import { errors } from "@/app/common/utils/ultils";
import { signIn, SignInResponse } from "next-auth/react";
import { useState } from "react";
import Spinner from "@/components/ui/spinner";

// Form Schema
const formSchema = z.object({
  email: z
    .string({
      required_error: "Trường này không được trống.",
    })
    .email({
      message: "Email đã nhập không hợp lệ.",
    }),
  password: z
    .string({
      required_error: "Trường này không được trống.",
    })
    .min(6, {
      message: "Mật khẩu phải trên 6 ký tự.",
    })
    .regex(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).{6,}$/, {
      message:
        "Mật khẩu phải ít nhất 6 ký tự, bao gồm chữ số, số, chữ hoa, chữ thường, kí tự đặc biệt",
    }),
});

export default function Login() {
  // Router
  const router = useRouter();

  // Loading
  const [isLoading, setIsLoading] = useState<boolean>(false);

  // SearchParams
  const searchParams: ReadonlyURLSearchParams = useSearchParams();

  // 1. Define your form.
  const form = useForm<z.infer<typeof formSchema>>({
    resolver: zodResolver(formSchema),
    defaultValues: {
      email: "",
      password: "",
    },
  });

  // 2. Define a submit handler.
  function onSubmit(values: z.infer<typeof formSchema>) {
    // Enable loading
    setIsLoading(true);

    // Promise
    const promise = () =>
      new Promise(async (resolve, reject) =>
        setTimeout(async () => {
          // Fetcher
          const signInResult: SignInResponse | undefined = await signIn("credentials", {
            email: values.email,
            password: values.password,
            redirect: false,
            callbackUrl: searchParams?.get("callbackUrl") || "/",
          });

          // Sign in
          !signInResult?.ok || signInResult?.error
            ? reject(signInResult?.error)
            : resolve(signInResult?.ok);
        }, 2000),
      );

    // Toast
    toast.promise(promise, {
      loading: "Đang đăng nhập, vui lòng đợi...",
      success: () => {
        // Route to login
        router.push("/client/chats");

        // Show message
        return "Đăng nhập thành công";
      },
      error: (message: string[]) => errors(toast, message),
      finally: () => {
        // Disable loading
        setIsLoading(true);
      },
    });
  }

  // Return
  return (
    <div className="mx-auto grid w-[350px] gap-6">
      <div className="grid gap-2 text-center">
        <h1 className="text-3xl font-bold">Đăng nhập</h1>
        <p className="text-[14px] text-muted-foreground">
          Chào mừng bạn đến với Chatbot EAUT của trường Đại học Công Nghệ Đông Á
        </p>
      </div>
      <div>
        <Form {...form}>
          <form onSubmit={form.handleSubmit(onSubmit)} className="grid gap-4">
            <FormField
              control={form.control}
              name="email"
              render={({ field }) => (
                <FormItem className="grid gap-2">
                  <FormLabel htmlFor="email">Email</FormLabel>
                  <FormControl>
                    <Input placeholder="your.email@gmail.com" type="text" {...field} />
                  </FormControl>
                  <FormMessage />
                </FormItem>
              )}
            />
            <FormField
              control={form.control}
              name="password"
              render={({ field }) => (
                <FormItem className="grid gap-2">
                  <Label htmlFor="password">Mật khẩu</Label>
                  <FormControl>
                    <Input type="password" placeholder="••••••••" {...field} />
                  </FormControl>
                  <FormMessage />
                </FormItem>
              )}
            />
            <Link href="#" className="ml-auto inline-block text-sm underline">
              Quên mật khẩu?
            </Link>
            <Button type="submit" className="w-full flex gap-3 items-center" disabled={isLoading}>
              {isLoading && <Spinner/>} 
              <span className="mt-[2.5px]">Đăng nhập</span>
            </Button>
          </form>
        </Form>
        <div className="mt-4 text-center text-sm">
          Bạn chưa có tài khoản?{" "}
          <Link href="/auth/register" className="underline">
            Đăng ký
          </Link>
        </div>
      </div>
    </div>
  );
}

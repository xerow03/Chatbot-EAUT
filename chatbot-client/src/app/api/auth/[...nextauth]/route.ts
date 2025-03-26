import { GenderEnum } from "@/app/common/enum/gender.enum";
import { fetcher } from "@/app/common/utils/fetcher";
import NextAuth from "next-auth";
import CredentialsProvider from "next-auth/providers/credentials";

type SessionInfo = {
  user: {
    _id: string;
    firstname: string;
    email: string;
    lastname: string;
    image: string;
    avatar: string;
    gender: GenderEnum;
  };
  token: string;
};


// Auth Options
export const authOptions: any = {
  providers: [
    CredentialsProvider({
      name: "Credentials",
      credentials: {
        email: { label: "Email", type: "email" },
        password: { label: "Password", type: "password" },
      },
      async authorize(
        credentials: Record<"email" | "password", string> | undefined,
      ): Promise<any> {
        // Check credentials
        if (!credentials) return null;

        // Response
        const res: any = await fetcher({
          method: "POST",
          url: "/auth/login",
          payload: {
            email: credentials?.email,
            password: credentials?.password,
          },
        });


        // Check Error
        if (!res?.ok) {
          // Check status
          if (!res?.status) throw new Error("Có lỗi xảy ra phía Server");

          // Throw Error
          throw new Error(res.detail);
        };

        // Return
        return res ? res : null;
      },
    }),
  ],
  callbacks: {
    async session({ token: { data } }: any): Promise<SessionInfo | undefined> {
      // Return session info
      return data;
    },
    async jwt({ token, user }: any): Promise<any> {
      // If user is valid, return user
      if (user) return { ...token, ...user };

      //  Return
      return token;
    },
  },
  pages: {
    signIn: "/auth/login",
  },
};

// Handler
const handler = NextAuth(authOptions);

export { handler as GET, handler as POST };

import Messages from "./Messages";

export default interface Conversations {
  _id: string;
  user_id: string;
  desc: string;
  name: string;
  soft_delete: boolean;
  last_message: Messages;
  created_at: string | Date;
  updated_at: string | Date;
}

export default interface Messages {
     _id?: string;
     conversation?: string;
     message: string;
     sender: string;
     send_at: string | Date;
     updated_at?: string | Date;
}
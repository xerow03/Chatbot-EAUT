"use client";
import React from 'react';
import { ChatsContext } from '@/app/client/providers/chats.provider';

// Use Chats
export const useChats = () => React.useContext<any>(ChatsContext).list;

export const useCurrentChat = () => React.useContext<any>(ChatsContext).cur;

export const useSocket = () => React.useContext<any>(ChatsContext)?.socket.get;


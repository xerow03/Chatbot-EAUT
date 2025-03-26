import { Column } from '@tanstack/react-table';
import { CSSProperties } from 'react';

export const getCommonPinningStyles = (column: Column<any>): CSSProperties => {
  const isPinned = column.getIsPinned();
  return {
    left: isPinned === 'left' ? `${column.getStart('left')}px` : undefined,
    right: isPinned === 'right' ? `${column.getAfter('right')}px` : undefined,
    position: isPinned ? 'sticky' : 'relative',
    backgroundColor: 'white',
    zIndex: isPinned ? 1 : 0,
  };
};

export const errors = (toast: any, error: string[] | string) => {
  // Check list error
  if (Array.isArray(error)) {
    // Show error
    error.forEach((err: string, i: number) => {
      i !== error.length - 1 && toast.error(err);
    });

    // Return
    return error[0];
  } else {
    // Return
    return error;
  }
};

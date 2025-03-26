"use client";
import styles from "./styles.module.css";

export default function DotLoading() {
  return (
    <div className="w-[35px] flex justify-center">
      <div className={styles["dot-elastic"]}></div>
    </div>
  );
}

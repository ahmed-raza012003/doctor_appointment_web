"use client";
import Image from "next/image";
import Link from "next/link";

const Whatsapp_logo = () => {
  return (
    <section className="z-30 fixed bottom-5 right-4">
      <div className="whatsapp-container transition-transform hover:scale-110">
        <Link
          href="https://wa.me/1234567890"
          target="_blank"
          rel="noopener noreferrer"
        >
          <Image
            src="/svg/whatsapp.svg"
            width={50}
            height={50}
            alt="Whatsapp logo"
            className="w-12 h-12"
          />
        </Link>

        <style jsx>{`
          .whatsapp-container {
            display: inline-block;
            animation: pulseScale 2s ease-in-out infinite;
          }

          @keyframes pulseScale {
            0%,
            100% {
              transform: scale(1);
            }
            50% {
              transform: scale(1.1);
            }
          }
        `}</style>
      </div>
    </section>
  );
};

export default Whatsapp_logo;

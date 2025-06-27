"use client";
import Image from "next/image";
import Link from "next/link";

const Card = ({ image, heading, content, link }) => {
  return (
    <div>
      <section className="relative flex flex-col bg-text overflow-hidden w-[300px] h-[400px] p-4 rounded-lg shadow-lg hover:shadow-xl transform transition-all duration-[700ms] ease-in-out hover:scale-110">
        <Link href={link}>
          {/* Image */}
          <div className="relative w-full h-[180px]">
            <Image
              src={image}
              alt="Blog Image"
              layout="fill"
              className="object-cover rounded"
            />
          </div>
        </Link>
        {/* Content */}
        <div className="flex flex-col gap-2 mt-3 flex-grow overflow-hidden">
          <h1 className="text-center font-bold text-2xl text-primary">
            {heading}
          </h1>

          {/* Truncated paragraph with ellipsis */}
          <p className="text-black text-justify text-sm px-1 line-clamp-3">
            {content}
          </p>
        </div>

        {/* Read More button */}
        <div className="mt-auto pt-3 flex justify-end">
          <Link href={link} className="bg-primary text-white py-2 px-4 rounded">
            Read More
          </Link>
        </div>
      </section>
    </div>
  );
};

export default Card;

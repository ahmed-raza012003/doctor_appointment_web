// In Card.js
"use client";
import React from "react";
import Image from "next/image";

const Card = ({ image, heading, content }) => {
return (
    <section className="flex flex-col items-center justify-between bg-text overflow-hidden w-[300px] h-[450px] pb-4 px-3 rounded-lg shadow-lg hover:shadow-xl transform transition-all duration-[700ms] ease-in-out hover:-translate-y-3 gap-5"> 
        <div>
            <Image src={image} alt="Service Wali Image" width={100} height={100} className="object-cover rounded" />
        </div>
        <div className="flex flex-col items-center gap-3 h-full">
            <h1 className="text-center font-bold text-2xl text-primary">{heading}</h1>
            <p className="text-black text-justify overflow-hidden px-2">{content}</p>
        </div>
    </section>
);
};

export default Card;

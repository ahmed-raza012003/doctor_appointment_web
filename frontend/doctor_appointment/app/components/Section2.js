import React from "react";
import Image from "next/image";

const data = [
  {
    id: 1,
    img: "/Doctor Images/d1.webp",
    title: "Consult Online Consultation",
    content: "Instantly connect with Specialists through Video call.",
  },
  {
    id: 2,
    img: "/Doctor Images/d2.webp",
    title: "In-Clinic Appointment",
    content:
      "Schedule an appointment at our clinic for in-person consultation.",
  },
  {
    id: 3,
    img: "/Doctor Images/d3.webp",
    title: "Lab Tests",
    content: "Get your lab tests done quickly and easily.",
  },
  {
    id: 4,
    img: "/Doctor Images/d4.webp",
    title: "Procedure and Surgery",
    content: "Get expert care for your surgical needs.",
  },
];

export const Section2 = () => {
  return (
    <section className="p-4 my-2 ff py-5">
      <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 place-items-center">
        {data.map((item) => (
          <div
            key={item.id}
            className="bg-primary text-text rounded-2xl w-80 flex flex-col"
          >
            <div className="flex flex-col h-[35vh]">
              <div className="w-full h-48 relative bg-[var(--bg-secondary)] rounded-t-2xl overflow-hidden">    
                <Image
                  src={item.img}
                  alt={item.title}
                  fill
                  className="object-contain rounded-t-2xl"
                />
              </div>
              <div className="text-start pl-3 py-2 flex-1">
                <h2 className="text-lg font-semibold">{item.title}</h2>
                <p>{item.content}</p>
              </div>
            </div>
          </div>
        ))}
      </div>
    </section>
  );
};

export default Section2;

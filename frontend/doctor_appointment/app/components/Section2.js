import React from "react";
import Image from "next/image";

const data = [
    {
        id: 1,
        img: "/Doctor Images/main_doctor.webp",
        title: "Consult Online Consultation",
        content: "Instantly connect with Specialists through Video call.",
    },
    {
        id: 2,
        img: "/Doctor Images/main_doctor.webp",
        title: "In-Clinic Appointment",
        content: "Schedule an appointment at our clinic for in-person consultation.",
    },
    {
        id: 3,
        img: "/Doctor Images/main_doctor.webp",
        title: "Lab Tests",
        content: "Get your lab tests done quickly and easily.",
    },
    {
        id: 4,
        img: "/Doctor Images/main_doctor.webp",
        title: "Procedure and Surgery",
        content: "Get expert care for your surgical needs.",
    },
];
export const Section2 = () => {
    return (
        <section className=" p-4 my-2 ff py-5">
            <div className="col-span-2 md:col-span-4 text-center grid grid-cols-2 md:grid-cols-4 gap-4">
                {data.map((item) => (
                    <div
                        className="bg-primary text-start rounded-2xl text-text w-80"
                        key={item.id}
                    >
                        <Image
                            className="rounded-t-2xl w-full overflow-hidden"
                            src={item.img}
                            alt="Description"
                            width={300}
                            height={300}
                        />
                        <div className="text-start pl-3 py-2 ">
                            <h2 className="text-lg font-semibold">
                                {item.title}
                            </h2>
                            <p>{item.content}</p>
                        </div>
                    </div>
                ))}
            </div>
        </section>
    );
};
export default Section2;

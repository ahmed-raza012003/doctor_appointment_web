"use client";
import React, { useState } from "react";
import Image from "next/image";
// import faqData from "../data/faqData"; // Adjust path based on your file structure

const faqData = [
  {
    question: "What is primary care?",
    answer: "Primary care is the first point of contact for general health concerns."
  },
  {
    question: "Do I need to select a primary care provider?",
    answer: "Yes, having a primary care provider helps with continuous and coordinated care."
  },
  {
    question: "Nutrition and Weight Loss",
    answer: "Our nutrition programs are designed to support weight loss and healthy living."
  },
  {
    question: "Online and virtual services",
    answer: "You can consult doctors online for various services including checkups and prescriptions."
  }
];

const Faq = () => {
  const [openIndex, setOpenIndex] = useState(null);

  const toggle = (index) => {
    setOpenIndex(openIndex === index ? null : index);
  };

  return (
    <section className="flex flex-col md:flex-row justify-between items-center w-full px-4 md:px-12 py-10 gap-6 bg-primary">
      {/* Image Section */}
      <div className="flex justify-center w-full md:w-1/2">
        <Image
          src="/Doctor Images/FAQ.png"
          width={400}
          height={400}
          alt="FAQ wala Doctor"
        />
      </div>

      {/* FAQs Section */}
      <div className="w-full md:w-1/2">
        <h1 className="text-3xl font-bold mb-6 text-text">FAQs</h1>

        <div className="flex flex-col gap-2">
          {faqData.map((faq, index) => (
            <div
              key={index}
              className="bg-[#21A4AD] shadow-md rounded-2xl transition"
            >
              <button
                onClick={() => toggle(index)}
                className="w-full flex justify-between items-center p-4 font-medium text-text hover:bg-[#25BED2]"
              >
                <span>{faq.question}</span>
                <span className="text-xl text-text-secondary">
                  {openIndex === index ? "▲" : "▼"}
                </span>
              </button>
              {openIndex === index && (
                <div className="px-4 pb-4 bg-text rounded-b-2xl text-primary">{faq.answer}</div>
              )}
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default Faq;

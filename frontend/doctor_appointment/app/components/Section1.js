"use client";
import { useState, useEffect } from "react";
import Image from "next/image";
import classNames from "classnames";

const infoList = [
  "50M+ Patients Served",
  "10M+ Teleconsults",
  "25K+ Doctors Available",
  "100+ Specialties Covered",
];

const Section1 = () => {
  const [infoIndex, setInfoIndex] = useState(0);
  const [fade, setFade] = useState(true);

  useEffect(() => {
    const interval = setInterval(() => {
      setFade(false);
      setTimeout(() => {
        setInfoIndex((prev) => (prev + 1) % infoList.length);
        setFade(true);
      }, 300);
    }, 3000);

    return () => clearInterval(interval);
  }, []);

  return (
    <section className="bg-primary mx-4 md:mx-8 my-10 relative rounded-4xl overflow-hidden">
      <div className="flex flex-col-reverse md:flex-row justify-between items-center p-6 md:px-8 md:py-10 gap-6 md:gap-0">
        {/* Left Text Section */}
        <div className="flex flex-col gap-4 w-full md:w-1/2">
          <h1 className="font-bold text-3xl sm:text-4xl md:text-5xl leading-snug md:leading-tight text-black">
            Find and Book The <br />
            <span className="text-text">Best Doctor</span> near you
          </h1>

          {/* Animated Info Box */}
          <div
            className={classNames(
              "flex gap-2 items-center px-4 py-2 rounded-lg w-fit text-white transition-opacity duration-1000 ease-in-out",
              "backdrop-blur-md bg-gradient-to-r from-black/60 to-black/40 shadow-lg",
              {
                "opacity-0": !fade,
                "opacity-100": fade,
              }
            )}
          >
            <Image
              src="/tick.svg"
              width={20}
              height={20}
              alt="Tick Icon"
              className="inline-block"
            />
            <span className="text-sm font-medium">{infoList[infoIndex]}</span>
          </div>

          {/* Buttons */}
          <div className="flex gap-3 mt-4 flex-wrap sm:flex-nowrap">
            <button className="bg-white text-primary font-semibold px-4 py-2 rounded-full shadow hover:bg-gray-100 transition text-sm sm:text-base">
              In-Clinic
            </button>
            <button className="bg-white text-primary font-semibold px-4 py-2 rounded-full shadow hover:bg-gray-100 transition text-sm sm:text-base">
              Online Consultation
            </button>
          </div>
        </div>

        {/* Right Image Section */}
        <div className="w-full md:w-1/2 flex justify-center md:justify-end">
          <Image
            src="/Doctor Images/main_doctor.webp"
            width={500}
            height={500}
            alt="Main Doctor"
            className="object-contain w-full sm:w-full md:max-w-[380px] h-auto rounded-xl"
            priority
          />
        </div>
      </div>
    </section>
  );
};

export default Section1;

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
    <section className="relative mx-4 md:mx-8 my-10 rounded-4xl overflow-hidden p-6 sm:p-10 text-white bg-gradient-to-r from-[#11849B] via-[#25BED2] to-[#11849B] bg-[length:400%] animate-gradient-x">
      {/* Animated Blobs for background */}
      <div className="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div className="absolute w-80 h-80 bg-white opacity-10 rounded-full blur-3xl -top-10 -left-10 animate-pulse"></div>
        <div className="absolute w-96 h-96 bg-[#25BED2] opacity-20 rounded-full blur-2xl top-32 -right-20 animate-ping"></div>
      </div>

      <div className="relative z-10 flex flex-col-reverse md:flex-row justify-between items-center gap-10">
        {/* Left Text Section */}
        <div className="w-full md:w-1/2 flex flex-col gap-6 text-center md:text-left">
          <h1 className="font-bold text-3xl sm:text-4xl md:text-5xl leading-snug text-black">
            Find and Book the <br />
            <span className="text-white">Best Doctor</span> near you
          </h1>

          {/* Animated Info Box */}
          <div
            className={classNames(
              "mx-auto md:mx-0 flex gap-2 items-center px-4 py-2 rounded-lg w-fit text-white transition-opacity duration-700 ease-in-out",
              "backdrop-blur-sm bg-white/10 shadow-md",
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
            <span className="text-sm sm:text-base font-medium">
              {infoList[infoIndex]}
            </span>
          </div>

          {/* Buttons */}
          <div className="flex flex-col sm:flex-row justify-center md:justify-start gap-3 mt-4">
            <button className="bg-white text-primary font-semibold px-6 py-3 rounded-full shadow-md hover:bg-gray-100 transition text-sm sm:text-base">
              In-Clinic
            </button>
            <button className="bg-white text-primary font-semibold px-6 py-3 rounded-full shadow-md hover:bg-gray-100 transition text-sm sm:text-base">
              Online Consultation
            </button>
          </div>
        </div>

        {/* Right Image Section */}
        <div className="w-full md:w-1/2 flex justify-center md:justify-end">
          <div className="relative">
            <div className="absolute -inset-4 bg-white/20 rounded-full blur-2xl z-0"></div>
            <Image
              src="/Doctor Images/main_doctor.webp"
              width={500}
              height={500}
              alt="Main Doctor"
              className="relative z-10 object-contain w-full sm:w-full md:max-w-[380px] h-auto rounded-xl"
              priority
            />
          </div>
        </div>
      </div>
    </section>
  );
};

export default Section1;

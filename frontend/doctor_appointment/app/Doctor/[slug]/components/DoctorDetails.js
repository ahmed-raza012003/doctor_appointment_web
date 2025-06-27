"use client";
import React, { useEffect, useState } from "react";
import Image from "next/image";


const DoctorDetail = ({data}) => {
  const [doctor, setDoctor] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");



  useEffect(() => {
    const fetchDoctor = async () => {
      try {
        setDoctor(data);
      } catch (err) {
        setError("Failed to load doctor data");
      } finally {
        setLoading(false);
      }
    };
    fetchDoctor();
  }, []);

  if (loading) return <p className="text-center mt-20">Loading...</p>;
  if (error) return <p className="text-center text-red-500 mt-20">{error}</p>;

  return (
    <section className="bg-primary py-10 px-4 sm:px-6 lg:px-8 rounded-2xl">
      <div className="w-full lg:max-w-5xl lg:mx-auto flex flex-col lg:flex-row p-6 lg:p-10 gap-8 rounded-lg shadow-lg bg-[var(--colour-secondary)] text-text">
        {/* Doctor Image */}
        <div className="relative m-w-24 m-h-24 sm:w-32 sm:h-32 lg:w-40 lg:h-40 rounded-full border-2 border-gray-200 self-center lg:self-start">
          <Image
            src={doctor.image}
            width={200}
            height={200}
            alt="Doctor"
            className="w-full h-full object-cover overflow-hidden rounded-full"
          />
          <div className="absolute z-10 bottom-0 right-0 bg-text rounded-full p-1 shadow-md">
            <Image
              src="/tick.svg"
              alt="Verified"
              width={24}
              height={24}
              className=""
            />
          </div>
        </div>

        {/* Content */}
        <div className="flex flex-col w-full">
          <div className="text-text">
            <h1 className="text-2xl sm:text-3xl lg:text-4xl font-bold ">
              {doctor.name}
            </h1>
            <p className="text-sm sm:text-base mt-2">{doctor.specialties}</p>
            <p className="text-sm sm:text-base  mt-1">
              {doctor.qualifications}
            </p>
            {doctor.isVerified && (
              <span className="inline-block mt-3 px-3 py-1 text-xs font-medium text-white bg-green-600 rounded">
                PMDC Verified
              </span>
            )}
          </div>

          <div className="mt-6 border-t-2 border-text  pt-6 grid grid-cols-1 sm:grid-cols-3 gap-6 text-center text-sm text-gray-700">
            <div className="text-text">
              <p className="font-medium">Wait Time</p>
              <p className="font-bold text-xl py-2">{doctor.waitTime}</p>
            </div>
            <div className="text-text">
              <p className="font-medium">Experience</p>
              <p className="font-bold text-xl py-2">{doctor.experience}</p>
            </div>
            <div className="text-text">
              <p className="font-medium">Satisfied Patients</p>
              <p className="font-bold text-xl py-2">
                {doctor.satisfactionScore} ({doctor.satisfiedPatients})
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default DoctorDetail;

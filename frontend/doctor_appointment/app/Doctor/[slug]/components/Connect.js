"use client";

import React, { useEffect, useState } from "react";
import { doctorsData } from "@/app/data/DoctorData";
import DoctorDetail from "./DoctorDetails";
import DoctorServices from "./DoctorServices";
import BookingApp from "./BookingApp";

const Connect = ({ doctor }) => {
  const [isMobile, setIsMobile] = useState(false);

  useEffect(() => {
    let timeoutId;

    const handleResize = () => {
      clearTimeout(timeoutId);
      timeoutId = setTimeout(() => {
        setIsMobile(window.innerWidth < 1024);
      }, 150);
    };

    handleResize();
    window.addEventListener("resize", handleResize);
    return () => window.removeEventListener("resize", handleResize);
  }, []);

  if (!doctor) return <p className="text-center mt-10">Doctor not found</p>;

  // Extract only the relevant fields to pass to DoctorDetail
  const {
    name,
    specialties,
    qualifications,
    image,
    isVerified,
    waitTime,
    experience,
    satisfactionScore,
    satisfiedPatients,
  } = doctor;

  const data = {
    name,
    specialties,
    qualifications,
    image,
    isVerified,
    waitTime,
    experience,
    satisfactionScore,
    satisfiedPatients,
  };

  return (
    <div className="min-h-screen w-full p-4">
      <div className="flex flex-row gap-6">
        {/* Left Side: Doctor Detail and Services */}
        <div className="w-full lg:w-2/3 flex flex-col gap-4" id="left-content">
          <DoctorDetail data={data} />

          {isMobile && (
            <div
              className="w-full flex flex-col gap-4 mb-4"
              id="mobile-booking"
            >
              <BookingApp name="Skin Life Clinic" />
              <BookingApp name="Integrated Medical Hospital" />
            </div>
          )}

          <DoctorServices
            name={doctor.name}
            satisfactionScore={doctor.satisfactionScore}
            satisfiedPatients={doctor.satisfiedPatients}
            allServices={doctor.allServices}
            educationEntries={doctor.educationEntries}
            specializationEntries={doctor.specializationEntries}
            reviewCategories={doctor.reviewCategories}
            patientReviews={doctor.patientReviews}
            bioText={doctor.bioText}
            qualificationsText={doctor.qualificationsText}
            experienceText={doctor.experienceText}
            activismText={doctor.activismText}
            specialInterestsText={doctor.specialInterestsText}
            contactDetailsText={doctor.contactDetailsText}
            professionalMembershipText={doctor.professionalMembershipText}
          />
        </div>

        {/* Right Side: Sticky Booking Section */}
        {!isMobile && (
          <div className="w-full lg:w-1/3 relative">
            <div className="sticky top-4">
              <div className="flex flex-col gap-4">
                <BookingApp name="Skin Life Clinic" />
                <BookingApp name="Integrated Medical Hospital" />
              </div>
            </div>
          </div>
        )}
      </div>
    </div>
  );
};

export default Connect;

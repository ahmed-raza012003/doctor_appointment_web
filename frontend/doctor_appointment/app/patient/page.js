"use client";

import React, { useState } from "react";
import { useRouter } from "next/navigation";
import { doctorsData } from "../data/DoctorData"; // Make sure path is correct

export default function Page() {
  const [selectedDoctor, setSelectedDoctor] = useState(null);
  const [selectedService, setSelectedService] = useState("");
  const [selectedTime, setSelectedTime] = useState("");
  const [appointmentType, setAppointmentType] = useState("");
  const router = useRouter();

  const handleDoctorChange = (e) => {
    const doctorSlug = e.target.value;
    const doctor = doctorsData.find((doc) => doc.slug === doctorSlug);
    setSelectedDoctor(doctor);
    setSelectedService("");
    setSelectedTime("");
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    if (!selectedDoctor || !selectedService || !selectedTime || !appointmentType) {
      alert("❌ Please fill in all the fields.");
      return;
    }

    const appointmentData = {
      doctorSlug: selectedDoctor.slug,
      doctorName: selectedDoctor.name,
      service: selectedService,
      time: selectedTime,
      type: appointmentType,
      createdAt: new Date().toISOString(),
    };

    console.log("✅ Appointment Data:", appointmentData);

    // Redirect or submit to backend
    setTimeout(() => {
      router.push("/");
    }, 300);
  };

  return (
    <section className="p-4 min-h-screen bg-primary rounded-2xl my-3 text-text">
      <h1 className="w-full text-center text-3xl font-bold mb-8">
        Book Your Appointment
      </h1>

      <form
        onSubmit={handleSubmit}
        className="max-w-xl mx-auto space-y-6 bg-white p-6 rounded-xl shadow-lg text-black"
      >
        {/* Select Doctor */}
        <div>
          <label htmlFor="doctor" className="block font-semibold mb-2">
            Select Doctor
          </label>
          <select
            id="doctor"
            onChange={handleDoctorChange}
            className="w-full p-3 border border-gray-300 rounded-lg"
            required
          >
            <option value="">-- Choose a doctor --</option>
            {doctorsData.map((doctor) => (
              <option key={doctor.slug} value={doctor.slug}>
                {doctor.name}
              </option>
            ))}
          </select>
        </div>

        {/* Select Service */}
        {selectedDoctor && (
          <div>
            <label htmlFor="service" className="block font-semibold mb-2">
              Select Service
            </label>
            <select
              id="service"
              className="w-full p-3 border border-gray-300 rounded-lg"
              value={selectedService}
              onChange={(e) => setSelectedService(e.target.value)}
              required
            >
              <option value="">-- Choose a service --</option>
              {selectedDoctor.allServices.map((service) => (
                <option key={service} value={service}>
                  {service}
                </option>
              ))}
            </select>
          </div>
        )}

        {/* Select Time */}
        {selectedDoctor && (
          <div>
            <label htmlFor="time" className="block font-semibold mb-2">
              Select Time
            </label>
            <select
              id="time"
              className="w-full p-3 border border-gray-300 rounded-lg"
              value={selectedTime}
              onChange={(e) => setSelectedTime(e.target.value)}
              required
            >
              <option value="">-- Choose a time --</option>
              {selectedDoctor.fixedTimeSlots.map((slot) => {
                const label = `${slot.day} (${slot.startTime} - ${slot.endTime})`;
                return (
                  <option key={`${slot.day}-${slot.startTime}`} value={label}>
                    {label}
                  </option>
                );
              })}
            </select>
          </div>
        )}

        {/* Appointment Type */}
        <div>
          <label className="block font-semibold mb-2">Appointment Type</label>
          <div className="flex gap-4">
            <label className="flex items-center gap-2">
              <input
                type="radio"
                name="type"
                value="inclinic"
                onChange={(e) => setAppointmentType(e.target.value)}
                required
              />
              In-clinic
            </label>
            <label className="flex items-center gap-2">
              <input
                type="radio"
                name="type"
                value="online"
                onChange={(e) => setAppointmentType(e.target.value)}
              />
              Online Consultation
            </label>
          </div>
        </div>

        {/* Submit Button */}
        <div>
          <button
            type="submit"
            className="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg"
          >
            Book Appointment
          </button>
        </div>
      </form>
    </section>
  );
}

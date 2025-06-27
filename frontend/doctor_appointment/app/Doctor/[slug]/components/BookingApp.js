"use client";
import React, { useState } from "react";

const fixedTimeSlots = [
  { day: "Today", startTime: "10:00 AM", endTime: "11:00 AM" },
  { day: "Tomorrow", startTime: "12:00 PM", endTime: "01:00 PM" },
  { day: "Monday", startTime: "03:30 PM", endTime: "04:30 PM" },
  { day: "Wednesday", startTime: "06:00 PM", endTime: "07:00 PM" },
  { day: "Friday", startTime: "08:15 PM", endTime: "09:15 PM" },
];
const clinicData = {
  fee: "Rs. 4,000",
  address: "Link-2, Street-1, Near CSD, Islamabad",
};

const BookingApp = ({name}) => {
  const [dropdownOpen, setDropdownOpen] = useState(false);

  const toggleDropdown = () => setDropdownOpen(!dropdownOpen);

  return (
    <div className="p-8 bg-[var(--colour-secondary)] rounded-lg shadow-md  w-full lg:max-w-md flex flex-col gap-5">
      <h2 className="text-xl font-bold text-text flex gap-3 items-center">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="17"
          height="18"
          viewBox="0 0 17 18"
          fill="none"
          style={{ flexShrink: 0 }}
        >
          <path
            d="M12.3446 5.12039V0.535004H4.58538V5.12039H0V17.465H6.87781V12.6518H10.0522V17.465H16.93V5.12039H12.3446ZM4.34721 14.2307H3.02247V12.6513H4.34721V14.2307ZM4.34721 10.7257H3.02247V9.14622H4.34721V10.7257ZM9.12735 10.7257H7.80261V9.14622H9.12735V10.7257ZM10.5368 5.52185H9.20486V6.8538H7.72514V5.52185H6.39319V4.0416H7.72514V2.70912H9.20486V4.0416H10.5368V5.52185ZM12.5802 9.14622H13.8223V10.7257H12.5802V9.14622ZM13.9075 14.2307H12.5828V12.6513H13.9075V14.2307Z"
            fill="#ffffff"
          />
        </svg>
        <span>{name}</span>
      </h2>

      <div className="mt-4 text-sm text-text flex flex-col gap-2 ">
        <div className="flex items-center justify-between ">
          <span className="font-semibold">Fee:</span>
          <span className="font-bold">{clinicData.fee}</span>
        </div>

        <div className="border-t-2 border-text-mid pt-2">
          <address className="not-italic">
            <div className="flex items-center justify-between">
              <span className="font-semibold">Address:</span>
              <div className="flex items-center gap-2">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 64 64"
                  className="w-5 h-5 text-text flex-shrink-0 mt-0.5"
                  fill="currentColor"
                >
                  <path d="M32,0C18.745,0,8,10.745,8,24c0,5.678,2.502,10.671,5.271,15l17.097,24.156C30.743,63.686,31.352,64,32,64s1.257-0.314,1.632-0.844L50.729,39C53.375,35.438,56,29.678,56,24C56,10.745,45.255,0,32,0z M48.087,39h-0.01L32,61L15.923,39h-0.01C13.469,35.469,10,29.799,10,24c0-12.15,9.85-22,22-22s22,9.85,22,22C54,29.799,50.281,35.781,48.087,39z" />
                  <path d="M32,14c-5.523,0-10,4.478-10,10s4.477,10,10,10s10-4.478,10-10S37.523,14,32,14z M32,32c-4.418,0-8-3.582-8-8s3.582-8,8-8s8,3.582,8,8S36.418,32,32,32z" />
                  <path d="M32,10c-7.732,0-14,6.268-14,14s6.268,14,14,14s14-6.268,14-14S39.732,10,32,10z M32,36c-6.627,0-12-5.373-12-12s5.373-12,12-12s12,5.373,12,12S38.627,36,32,36z" />
                </svg>
                <span className="font-semibold underline">
                  {clinicData.address}
                </span>
              </div>
            </div>
          </address>
        </div>

        <div className="border-t border-gray-200 pt-2">
          <div className="text-green-800 flex items-center justify-between">
            <div className="flex items-center gap-2">
              <svg
                className="w-4 h-4"
                viewBox="0 0 16 16"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fillRule="evenodd"
                  clipRule="evenodd"
                  d="M8 16C12.4183 16 16 12.4183 16 8C16 3.58172 12.4183 0 8 0C3.58172 0 0 3.58172 0 8C0 12.4183 3.58172 16 8 16ZM7 3V8.41421L10.2929 11.7071L11.7071 10.2929L9 7.58579V3H7Z"
                  fill="#00ff40"
                />
              </svg>
              <span>Available slots</span>
            </div>

            <button
              onClick={toggleDropdown}
              className="flex items-center gap-2 focus:outline-none"
            >
              <span className="font-semibold text-black">Select a time</span>
              <svg
                className={`w-4 h-4 transform transition-transform duration-300 ${
                  dropdownOpen ? "rotate-180" : ""
                }`}
                viewBox="0 0 1024 1024"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path d="M903.232 256l56.768 50.432L512 768 64 306.432 120.768 256 512 659.072z" />
              </svg>
            </button>
          </div>

          {dropdownOpen && (
            <div className="mt-2 bg-text text-primary rounded-md shadow p-2 space-y-2">
              {fixedTimeSlots.map((slot, idx) => (
                <div
                  key={idx}
                  className="flex justify-between px-4 py-3 hover:bg-text-secondary cursor-pointer rounded-lg transition"
                >
                  <span className="text-sm">{slot.day}</span>
                  <span className="text-sm font-semibold">
                    {slot.startTime} - {slot.endTime}
                  </span>
                </div>
              ))}
            </div>
          )}
        </div>
      </div>

      <button className="mt-4 w-full bg-primary font-bold text-white py-2 rounded hover:bg-text-secondary">
        Book Appointment
      </button>
    </div>
  );
};

export default BookingApp;

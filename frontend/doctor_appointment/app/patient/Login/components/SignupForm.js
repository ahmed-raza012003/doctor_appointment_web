"use client";
import React, { useState } from "react";
import { useForm } from "react-hook-form";
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";

function SignupForm() {
  const {
    register,
    handleSubmit,
    reset,
    watch,
    formState: { errors },
  } = useForm();

  const [dob, setDob] = useState(null);

  const onSubmit = (data) => {
    if (!dob) {
      alert("Please select your Date of Birth.");
      return;
    }

    const finalData = {
      fullName: data.fullName,
      email: data.email,
      phone: `+92${data.phone}`,
      password: data.password,
      gender: data.gender,
      dob: dob,
    };

    console.log("✅ Signup Data Object:", finalData);

    // TODO: API call here

    reset();
    setDob(null);
  };

  return (
    <form onSubmit={handleSubmit(onSubmit)} className="space-y-4">
      <div>
        <label className="block font-medium mb-1">Full Name</label>
        <input
          type="text"
          placeholder="Enter your full name"
          className="w-full px-4 py-2 border border-white rounded-md text-white placeholder-white bg-transparent"
          {...register("fullName", {
            required: "Full name is required",
          })}
        />
        {errors.fullName && (
          <p className="text-red-500 text-sm">{errors.fullName.message}</p>
        )}
      </div>

      <div>
        <label className="block font-medium mb-1">Email</label>
        <input
          type="email"
          placeholder="Enter your email"
          className="w-full px-4 py-2 border border-white rounded-md text-white placeholder-white bg-transparent"
          {...register("email", {
            required: "Email is required",
            pattern: {
              value: /^\S+@\S+\.\S+$/,
              message: "Enter a valid email address",
            },
          })}
        />
        {errors.email && (
          <p className="text-red-500 text-sm">{errors.email.message}</p>
        )}
      </div>

      <div>
        <label className="block font-medium mb-1">Password</label>
        <input
          type="password"
          placeholder="Enter password"
          className="w-full px-4 py-2 border border-white rounded-md text-white placeholder-white bg-transparent"
          {...register("password", {
            required: "Password is required",
            minLength: {
              value: 6,
              message: "Password must be at least 6 characters",
            },
          })}
        />
        {errors.password && (
          <p className="text-red-500 text-sm">{errors.password.message}</p>
        )}
      </div>

      <div>
        <label className="block font-medium mb-1">Re-enter Password</label>
        <input
          type="password"
          placeholder="Confirm your password"
          className="w-full px-4 py-2 border border-white rounded-md text-white placeholder-white bg-transparent"
          {...register("confirmPassword", {
            required: "Please confirm your password",
            validate: (value) =>
              value === watch("password") || "Passwords do not match",
          })}
        />
        {errors.confirmPassword && (
          <p className="text-red-500 text-sm">
            {errors.confirmPassword.message}
          </p>
        )}
      </div>

      <div>
        <label className="block font-medium mb-1">Date of Birth</label>
        <DatePicker
          selected={dob}
          onChange={(date) => setDob(date)}
          dateFormat="dd/MM/yyyy"
          showYearDropdown
          scrollableYearDropdown
          yearDropdownItemNumber={100}
          minDate={new Date(1960, 0, 1)}
          maxDate={new Date()}
          placeholderText="Select your date of birth"
          className="w-full px-4 py-2 border border-white rounded-md text-black bg-white"
        />
        {/* {!dob && (
          <p className="text-red-500 text-sm">Date of Birth is required</p>
        )} */}
      </div>
      <div>
  <label className="block font-medium mb-1">Phone Number</label>
  <div className="flex">
    <span className="px-3 py-2 bg-white text-black border border-white rounded-l-md">
      +92
    </span>
    <input
      type="tel"
      maxLength={10}
      placeholder="3123456789"
      className="w-full px-4 py-2 border border-white rounded-r-md text-white placeholder-white bg-transparent"
      {...register("phone", {
        required: "Phone number is required",
        pattern: {
          value: /^\d{10}$/,
          message: "Enter 10 digits after +92",
        },
      })}
    />
  </div>
  {errors.phone && (
    <p className="text-red-500 text-sm">{errors.phone.message}</p>
  )}
</div>


      <div>
        <label className="block font-medium mb-1">Gender</label>
        <select
          className="w-full px-4 py-2 border border-white rounded-md text-white bg-transparent"
          {...register("gender", { required: "Please select your gender" })}
        >
          <option value="">Select</option>
          <option value="male" className="text-black">
            Male
          </option>
          <option value="female" className="text-black">
            Female
          </option>
          <option value="other" className="text-black">
            Other
          </option>
        </select>
        {errors.gender && (
          <p className="text-red-500 text-sm">{errors.gender.message}</p>
        )}
      </div>

      <button
        type="submit"
        className="w-full text-white py-2 bg-[#21A4AD] rounded-md hover:bg-[#3a6164] transition-all"
      >
        Sign Up
      </button>
    </form>
  );
}

export default SignupForm;

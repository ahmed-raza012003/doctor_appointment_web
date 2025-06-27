"use client";
import React, { useState } from "react";

// Star SVG Component
const Star = ({ filled, onClick }) => (
  <svg
    onClick={onClick}
    xmlns="http://www.w3.org/2000/svg"
    className={`w-8 h-8 cursor-pointer transition-transform hover:scale-110 ${
      filled ? "fill-yellow-400 stroke-yellow-500" : "fill-none stroke-gray-400"
    }`}
    viewBox="0 0 24 24"
    strokeWidth="2"
  >
    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01L12 2z" />
  </svg>
);

const Review_section = () => {
  const [form, setForm] = useState({ name: "", email: "", message: "" });
  const [rating, setRating] = useState(0);
  const [errors, setErrors] = useState({
    name: "",
    email: "",
    message: "",
    rating: "",
  });

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
    setErrors({ ...errors, [e.target.name]: "" });
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    const newErrors = {
      name: form.name.trim() ? "" : "Name is required",
      email: /^\S+@\S+\.\S+$/.test(form.email) ? "" : "Valid email is required",
      message: form.message.trim() ? "" : "Message is required",
      rating: rating > 0 ? "" : "Rating is required",
    };

    setErrors(newErrors);

    if (
      !newErrors.name &&
      !newErrors.email &&
      !newErrors.message &&
      !newErrors.rating
    ) {
      console.log("Submitted:", { ...form, rating });
      setForm({ name: "", email: "", message: "" });
      setRating(0);
      alert("Thank you for your review!");
    }
  };

  return (
    <section className="bg-primary text-text w-full mx-auto my-10 p-6 md:p-10 rounded-3xl shadow-lg max-w-7xl">
      <h2 className="text-2xl md:text-3xl font-bold mb-6 ">
        Leave a Review
      </h2>

      {/* ⭐ Star Rating */}

      {/* 📝 Form */}
      <form onSubmit={handleSubmit} className="flex flex-col gap-6 w-full">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
          {/* Name and Email on the left */}
          <div className="flex flex-col gap-4">
            <div>
              <input
                type="text"
                name="name"
                value={form.name}
                onChange={handleChange}
                placeholder="Enter Your Name"
                className="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[var(--colour-secondary)]"
              />
              {errors.name && (
                <p className="text-red-500 text-sm mt-1">{errors.name}</p>
              )}
            </div>

            <div>
              <input
                type="email"
                name="email"
                value={form.email}
                onChange={handleChange}
                placeholder="Enter Your Email"
                className="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[var(--colour-secondary)]"
              />
              {errors.email && (
                <p className="text-red-500 text-sm mt-1">{errors.email}</p>
              )}
            </div>

            <div className="flex flex-col items-center mb-6">
              <div className="flex gap-2">
                {[1, 2, 3, 4, 5].map((star) => (
                  <Star
                    key={star}
                    filled={star <= rating}
                    onClick={() => setRating(star)}
                  />
                ))}
              </div>
              {errors.rating && (
                <p className="text-red-500 text-sm mt-1">{errors.rating}</p>
              )}
            </div>
          </div>

          {/* Description on the right */}
          <div>
            <textarea
              name="message"
              value={form.message}
              onChange={handleChange}
              rows={6}
              placeholder="Enter Your Description"
              className="w-full h-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[var(--colour-secondary)] resize-none"
            ></textarea>
            {errors.message && (
              <p className="text-red-500 text-sm mt-1">{errors.message}</p>
            )}
          </div>
        </div>

        {/* 📩 Submit Button */}
        <button
          type="submit"
          className="bg-text text-primary font-semibold px-8 py-4 rounded-full max-w-xs self-center hover:bg-[var(--colour-secondary)] transition"
        >
          Submit Review
        </button>
      </form>
    </section>
  );
};

export default Review_section;

"use client"; // This line is necessary for Next.js to treat this file as a client component
import React, { useState } from "react";

// Main App component that renders the DoctorReviewContent component
export default function DoctorReviewSummary({
  name,
  satisfactionScore,
    satisfiedPatients,
  reviewCategories,
  allServices,
  educationEntries,
  specializationEntries,
  patientReviews,
  bioText,
  qualificationsText,
  experienceText,
  activismText,
  specialInterestsText,
  contactDetailsText,
  professionalMembershipText,
}) {
  // Data for the review categories and their percentages
  // const reviewCategories = [
  //   { name: "Doctor Checkup", percentage: 85 },
  //   { name: "Clinic Environment", percentage: 90 },
  //   { name: "Staff Behaviour", percentage: 70 },
  // ];

  // // Data for services
  // const allServices = [
  //   "Acne Facial with Blue Light Therapy",
  //   "Adiposlim",
  //   "Brazilian Lift",
  //   "Acne Scar Treatment",
  //   "Advance Facials",
  //   "Chemical Peels",
  //   "Dermal Fillers",
  //   "Microdermabrasion",
  //   "Laser Hair Removal",
  //   "Tattoo Removal",
  //   "Botox Injections",
  //   "CoolSculpting",
  //   "Body Contouring",
  //   "Skin Tightening",
  // ];

  // // Data for education entries
  // const educationEntries = [
  //   "MBBS from King Edward Medical University, Lahore",
  //   "FCPS (Dermatology) from College of Physicians and Surgeons Pakistan",
  //   "Diploma in Aesthetic Medicine from American Academy of Aesthetic Medicine",
  //   "Fellowship in Hair Transplant from International Society of Hair Restoration Surgery",
  // ];
  // // Data for specialization entries
  // const specializationEntries = [
  //   "Dermatology",
  //   "Cosmetic Surgery",
  //   "Hair Restoration",
  //   "Aesthetic Medicine",
  // ];

  // const patientReviews = [
  //   {
  //     recommendation: false, // true for "I recommend", false for "I do not recommend"
  //     feedback: "My appointment was of 7:00 pm and they let me in on 7:55",
  //     patientName: "U",
  //     timeAgo: "5 months ago",
  //   },
  //   {
  //     recommendation: true,
  //     feedback: "I am heal by doctor medicine",
  //     patientName: "F** ***h",
  //     timeAgo: "6 months ago",
  //   },
  //   {
  //     recommendation: true,
  //     feedback:
  //       "Dr Tahir is a highly class doctor. He has helped me significantly and I would recommend him to others for the best consultancy.",
  //     patientName: "Z**n",
  //     timeAgo: "5 years ago", // This is the testimonial you already have
  //   },
  //   // Add more reviews here
  //   {
  //     recommendation: true,
  //     feedback:
  //       "Dr. Kamal is very professional and empathetic. My skin condition has improved drastically under his care.",
  //     patientName: "A***a K.",
  //     timeAgo: "3 weeks ago",
  //   },
  //   {
  //     recommendation: false, // true for "I recommend", false for "I do not recommend"
  //     feedback: "My appointment was of 7:00 pm and they let me in on 7:55",
  //     patientName: "U",
  //     timeAgo: "5 months ago",
  //   },
  //   {
  //     recommendation: true,
  //     feedback: "I am heal by doctor medicine",
  //     patientName: "F** ***h",
  //     timeAgo: "6 months ago",
  //   },
  //   {
  //     recommendation: true,
  //     feedback:
  //       "Dr Tahir is a highly class doctor. He has helped me significantly and I would recommend him to others for the best consultancy.",
  //     patientName: "Z**n",
  //     timeAgo: "5 years ago", // This is the testimonial you already have
  //   },
  //   // Add more reviews here
  //   {
  //     recommendation: true,
  //     feedback:
  //       "Dr. Kamal is very professional and empathetic. My skin condition has improved drastically under his care.",
  //     patientName: "A***a K.",
  //     timeAgo: "3 weeks ago",
  //   },
  //   {
  //     recommendation: false,
  //     feedback:
  //       "The clinic wait time was too long, even with an appointment. Doctor was good once I finally saw him.",
  //     patientName: "M. R***",
  //     timeAgo: "1 month ago",
  //   },
  // ];

  // // Data for "About Dr. Tahir Kamal" sections
  // const bioText =
  //   "Dr. Tahir Kamal is an eminent figure in the field of dermatology, often regarded as one of the best Dermatologists in Lahore. He is a highly qualified and experienced professional having expertise in a wide range of services such as Laser hair removal, Liposuction treatment of pigmentation problems, Nose and Lips Reshaping, Aging treatments with Dermal Fillers, Acne Scars, Genesis Treatment, Whole body Skin whitening treatments, Hyper pigmented patches etc. Dr. Tahir aims to provide state of the art dermatology treatments & procedures in Pakistan and is constantly involved in the development of dermatology practices in Pakistan.";

  // const qualificationsText =
  //   "Dr. Tahir Kamal completed his MBBS from King Edward Medical College which is one of the most renowned medical schools in Pakistan and FCPS Dermatology from College of Physicians & Surgeons, Pakistan. He attained his post graduation diploma from University of Wales College of Medicine, UK and DDSc with a distinction while being awarded with a gold medal for his excellent performance. Dr. Tahir is a PMDC Registered medical professional who is also a member of the American Academy of Cosmetic Surgery and is recognized by the local & International communities due to his extensive knowledge and prowess. Dr. Tahir Kamal received his training of Plastic and Cosmetic Treatments under the mentorship of renowned plastic Surgeons such as Dr Hakim Babar & Dr Khalid Butt (Plastic Surgeon). Dr Tahir has immense exposure to the advanced dermatology treatments used in top notch medical facilities around the globe and is properly trained from New Jersey, USA in Liposuction, earning the status of a Certified Liposuction Surgeon. He is a gold medalist with an exceptional educational background and has always been a high achieving individual throughout his period as a medical student and has continued to Excel in the field of Cosmetic treatments ever since.";

  // const experienceText =
  //   "Dr. Kamal has vast experience ranging over 20 years and is currently practicing as a Dermatologist & Cosmetologist at Skin Life Clinic, Lahore. In the past, he has served as Assistant Professor at Allama Iqbal Medical College. He has performed the roles of Medical Officer at Mayo Hospital, Lahore and Senior Registrar & Assistant professor of Dermatology at Jinnah Hospital, Lahore. He also has experience working as Assistant Professor at Skin Dept. Lahore General Teaching Hospital & Senior Medical Officer at Lahore General Hospital. Tahir Kamal has worked for a number of healthcare facilities in Pakistan and that is the reason, he has been able to reach such a high level of expertise as a consultant dermatologist. He has an impressive understanding of the South Asian demographic, specifically the underlying factors that are seriously impacting the beauty care of men & women in Pakistan and is capable enough to deal with these issues in an efficient manner.";

  // const activismText =
  //   "Dr. Tahir Kamal has a proactive approach when it comes to raising awareness related to cosmetic care in Pakistan. He has served the community both as a researcher and a professional in the field and is highly devoted in his pursuit of improving the quality of the cosmetology services in Pakistan. Dr. Tahir has been a key figure in conducting a number of researches and articles, that are published on a number of forums and is highly acclaimed by the local & International communities for his contribution to the field of dermatology. Dr. Tahir has made a lot of appearances on social media, spreading awareness on multiple topics for the guidance of Pakistani audiences, such as Acne skin problems, hair fall solutions etc. He aims to make full use of the advanced level skills & capabilities used globally, for the service of the Pakistani community. In a recent Interview available online, he discusses the most commonly found disease in the field of dermatology, which is acne and is found in men & women of different age groups in Pakistan. He stressed a lot against the use of home remedies for acne treatment and advised the patients to consult a skin specialist in case of any skin related issues. He further went on to explain the complications of hair fall and the factors that lead to excessive hair fall. He also explained the different treatments that are very effective against hair fall and the precautionary measures that can be taken to take better care of your hair. Dr. Tahir is an advocate for beauty care in Pakistan and makes use of every available platform to spread awareness for the masses in Pakistan. He is extremely driven in the pursuit of this mission and his dedication makes him one of the most accomplished dermatologists in Pakistan.";

  // const specialInterestsText =
  //   "Dr. Tahir Kamal is a competent dermatologist & cosmetologist having immense experience and is capable of handling a diverse range of services but his main area of Interest lies in Cosmetology & Cosmetic Surgery. His area of expertise include Acne, Cosmetic Surgery and Thread up lighting Warts Removal. Tahir Kamal is a proficient skin care specialist and has equipped himself with the latest methods & tools in order to meet the best results that match the standards set by the leading health care facilities in the world.";

  // const contactDetailsText =
  //   "In order to book an appointment with Dr. Tahir Kamal, you can call 042-38900939 or click the book appointment button on the right side of the page.";

  // const professionalMembershipText =
  //   "Dr. Tahir Kamal is a proud member of several prestigious medical organizations, including the American Academy of Dermatology, the International Society of Hair Restoration Surgery, and the Pakistan Association of Dermatologists. He regularly attends international conferences and workshops to stay updated with the latest advancements in his field.";

  // State to manage the visibility of all services
  const [showAllServices, setShowAllServices] = useState(false);
  const [showAllReviews, setShowAllReviews] = useState(false);

  // Determine which services to display when collapsed (e.g., first 5)
  const initialServicesCount = 5;
  const servicesToRender = showAllServices
    ? allServices
    : allServices.slice(0, initialServicesCount);

  // Define reusable classes for headings and subheadings
  const headingClass =
    "text-xl sm:text-2xl font-semibold w-fit text-text border-b-2 border-text  mb-4";
  const subheadingClass =
    "text-lg sm:text-xl font-semibold w-fit text-text border-b border-text mb-2";

  return (
    <div className="min-h-screen bg-primary rounded-2xl flex items-center justify-center p-4 sm:p-6 lg:p-8">
      {/* Light background for the page */}
      <div className="bg-[var(--colour-secondary)] text-text rounded-xl shadow-lg p-6 sm:p-8 lg:p-10 max-w-4xl mx-auto w-full">
        {/* Header section for reviews */}
        <div className="flex items-center mb-6">
          <svg
            className="w-6 h-6 sm:w-7 sm:h-7 text-yellow-500 mr-2"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.929 8.72c-.783-.57-.381-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"></path>
          </svg>
          <h2 className={headingClass}>
            {name}&#39;s Reviews{" "}
            <span className="text-gray-500 font-normal">(771)</span>
          </h2>
        </div>
        {/* Satisfaction and category breakdown section */}
        <div className="flex flex-col md:flex-row items-center md:items-start justify-between mb-8 space-y-6 md:space-y-0 md:space-x-12">
          {/* Satisfaction circle */}
          <div className="flex items-center space-x-4">
            <div className="relative w-28 h-28 sm:w-32 sm:h-32 rounded-full bg-gray-200 flex items-center justify-center font-bold text-2xl sm:text-3xl text-gray-800">
              {/* This div simulates the 97% circle fill using a radial gradient or by carefully styling */}
              <div
                className="absolute inset-0 rounded-full"
                style={{
                  background:
                    "radial-gradient(closest-side, white 79%, transparent 80% 100%), conic-gradient(#1A202C 97%, #E5E7EB 0%)",
                }}
              ></div>
              <span className="relative z-10 text-xl sm:text-2xl font-bold">
                {satisfactionScore}
              </span>
            </div>
            <p className="text-text text-lg sm:text-xl">
              Satisfied out of <br /> {satisfiedPatients} patients
            </p>
          </div>

          {/* Review categories and progress bars */}
          <div className="w-full md:w-1/2 text-text space-y-4">
            {reviewCategories.map((category, index) => (
              <div key={index} className="flex items-center">
                <span className="text-text text-base sm:text-lg w-36 sm:w-40 flex-shrink-0">
                  {category.name}
                </span>
                <div className="flex-grow bg-gray-200 rounded-full h-2.5 mx-3">
                  <div
                    className="bg-gray-800 h-2.5 rounded-full"
                    style={{ width: `${category.percentage}%` }}
                  ></div>
                </div>
                <span className="text-text font-medium text-base sm:text-lg w-10 text-right">
                  {category.percentage}%
                </span>
              </div>
            ))}
          </div>
        </div>
        {/* Patient testimonial section */}
        <div className="bg-gray-50 border border-gray-200 rounded-lg p-5 sm:p-6 mb-8">
          <p className="text-gray-700 text-base sm:text-lg italic mb-4">
            &quot;Dr Tahir is a highly class doctor. He has helped me
            significantly and I would recommend him to others for the best
            consultancy.&quot;
          </p>
          <p className="text-gray-500 text-sm sm:text-base">
            Verified patient: <span className="font-medium">Z**n</span> • 5
            years ago
          </p>
        </div>
        {/* Read all reviews button */}
        <div className="flex justify-center md:justify-start mb-8">
          <button className="px-6 py-3 text-text bg-primary border-gray-300 rounded-lg font-medium hover:bg-[var(--colour-secondary-dark)] transition-colors duration-200 text-base sm:text-lg">
            Read all reviews
          </button>
        </div>
        {/* Services section */}
        <div className="border-t-2 border-text-mid pt-8 mt-8 text-text">
          <div className="flex justify-between items-center mb-4">
            <h3 className={headingClass}>Services</h3>
            {allServices.length > initialServicesCount && (
              <button
                onClick={() => setShowAllServices(!showAllServices)}
                className="text-text hover:text-text-mid text-sm sm:text-base font-medium focus:outline-none"
              >
                {showAllServices ? "View less" : "View all"}
              </button>
            )}
          </div>
          <div
            className={`overflow-hidden transition-all duration-500 ease-in-out ${
              showAllServices
                ? "max-h-screen opacity-100"
                : "max-h-60 opacity-100"
            }`}
            style={{ overflow: showAllServices ? "visible" : "hidden" }}
          >
            <div className="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-2">
              {servicesToRender.map((service, index) => (
                <div
                  key={index}
                  className="flex items-center text-text text-base sm:text-lg"
                >
                  <span className="mr-2">•</span> {service}
                </div>
              ))}
            </div>
          </div>
        </div>
        {/* Education section */}
        <div className="border-t-2 border-text-mid pt-8 mt-8">
          <div className="flex justify-between items-center mb-4">
            <h3 className={headingClass}>Education</h3>
          </div>
          <div className="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-2">
            {educationEntries.map((education, index) => (
              <div
                key={index}
                className="flex items-center text-text text-base sm:text-lg"
              >
                <span className="mr-2">•</span> {education}
              </div>
            ))}
          </div>
        </div>
        {/* Specialization section */}
        <div className="border-t-2 border-text-mid pt-8 mt-8">
          <div className="flex justify-between items-center mb-4">
            <h3 className={headingClass}>Specialization</h3>
          </div>
          <div className="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-2">
            {specializationEntries.map((specialization, index) => (
              <div
                key={index}
                className="flex items-center text-text text-base sm:text-lg"
              >
                <span className="mr-2">•</span> {specialization}
              </div>
            ))}
          </div>
        </div>
        {/* Professional Membership section */}
        <div className="border-t-2 border-text-mid pt-8 mt-8">
          <div className="flex justify-between items-center mb-4">
            <h3 className={headingClass}>Professional Membership</h3>
          </div>
          <p className="text-text text-base sm:text-lg">
            {professionalMembershipText}
          </p>
        </div>
        <div className="border-t border-text-mid pt-8 mt-8">
          <h2 className={headingClass + " mb-6"}>About Dr. Tahir Kamal</h2>

          {/* Bio subheading */}
          <div className="mb-6 text-text">
            <h4 className={subheadingClass}>Bio</h4>
            <p className=" text-base sm:text-lg">{bioText}</p>
          </div>

          {/* Qualifications subheading */}
          <div className="mb-6">
            <h4 className={subheadingClass}>Qualifications</h4>
            <p className=" text-base sm:text-lg">{qualificationsText}</p>
          </div>

          {/* Experience subheading */}
          <div className="mb-6">
            <h4 className={subheadingClass}>Experience</h4>
            <p className=" text-base sm:text-lg">{experienceText}</p>
          </div>

          {/* Activism subheading */}
          <div className="mb-6">
            <h4 className={subheadingClass}>Activism</h4>
            <p className=" text-base sm:text-lg">{activismText}</p>
          </div>

          {/* Special Interests subheading */}
          <div className="mb-6">
            <h4 className={subheadingClass}>Special Interests</h4>
            <p className=" text-base sm:text-lg">{specialInterestsText}</p>
          </div>

          {/* Contact Details subheading */}
          <div className="mb-0">
            <h4 className={subheadingClass}>Contact Details</h4>
            <p className="text-base sm:text-lg">{contactDetailsText}</p>
          </div>
        </div>
        {/* Load More Reviews button */}
        <div className="border-t border-text-mid pt-8 mt-8">
          <h3 className={headingClass + " mb-6"}>Patient Reviews</h3>

          <div className="grid grid-cols-1 sm:grid-cols-2 gap-6">
            {(showAllReviews ? patientReviews : patientReviews.slice(0, 5)).map(
              (review, idx) => (
                <div
                  key={idx}
                  className="bg-gray-50 border border-gray-200 rounded-lg p-5 flex flex-col shadow-sm"
                >
                  <div className="flex items-center mb-2">
                    {review.recommendation ? (
                      <span className="inline-flex items-center text-green-600 font-semibold text-sm mr-2">
                        <svg
                          className="w-5 h-5 mr-1"
                          fill="none"
                          stroke="currentColor"
                          strokeWidth="2"
                          viewBox="0 0 24 24"
                        >
                          <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            d="M5 13l4 4L19 7"
                          />
                        </svg>
                        I recommend
                      </span>
                    ) : (
                      <span className="inline-flex items-center text-red-600 font-semibold text-sm mr-2">
                        <svg
                          className="w-5 h-5 mr-1"
                          fill="none"
                          stroke="currentColor"
                          strokeWidth="2"
                          viewBox="0 0 24 24"
                        >
                          <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                          />
                        </svg>
                        I do not recommend
                      </span>
                    )}
                    <span className="text-gray-500 text-xs">
                      {review.timeAgo}
                    </span>
                  </div>
                  <p className="text-gray-700 text-base mb-4">
                    {review.feedback}
                  </p>
                  <div className="text-gray-500 text-sm mt-auto">
                    <span className="font-medium">
                      Patient: {review.patientName}
                    </span>
                  </div>
                </div>
              )
            )}
          </div>

          {/* Only show "Load More Reviews" button if more than 5 reviews */}
          {patientReviews.length > 5 && (
            <div className="flex justify-center mt-8">
              <button
                className="px-6 py-3 bg-primary rounded-lg text-text font-medium hover:bg-text-secondary transition-colors duration-200 text-base sm:text-lg"
                onClick={() => setShowAllReviews((prev) => !prev)}
              >
                {showAllReviews ? "Show Less" : "Load More Reviews"}
              </button>
            </div>
          )}
        </div>
      </div>
    </div>
  );
}

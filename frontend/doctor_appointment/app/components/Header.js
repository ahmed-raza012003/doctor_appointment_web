// "use client";
// import React, { useState, useEffect,  useMemo } from "react";
// import Image from "next/image";
// import Link from "next/link";
// import { doctorsData } from "@/app/data/DoctorData";
// // import { servicesData } from "@/app/data/ServicesData";
// import { fetchCatData } from "@/app/data/CatData";
// // import { fetchServices } from "./fetchServices";
// import { getServicesData } from "@/app/data/servicesData";

// const MAIN_LOGO = process.env.NEXT_PUBLIC_MAIN_LOGO || "/fallback_logo.png";

// const getRandomDoctors = (list, count = 5) => {
//   const shuffled = [...list].sort(() => 0.5 - Math.random());
//   return shuffled.slice(0, Math.min(count, shuffled.length)).map((doctor) => ({
//     name: doctor.name,
//     slug: doctor.slug,
//     specialty: doctor.specialties,
//   }));
// };

// const getServiceNames = (services, count = null) => {
//   const simplified = services.map((item) => ({
//     name: item.name,
//   }));
//   if (count !== null) {
//     const shuffled = [...simplified].sort(() => 0.5 - Math.random());
//     return shuffled.slice(0, Math.min(count, simplified.length));
//   }
//   return simplified;
// };

// export const getServicesData = async () => {
//   const services = await fetchServices();
//   return services;
// };

// // const getServiceCategories = (data) => {
// //   return Object.keys(data).map((key) => ({ name: key }));
// // };
// const getServiceCategories = (catData) => {
//   return catData.map((item) => ({ name: item.name }));
// };

// const Header = () => {
//   const [isHoveredDoctor, setIsHoveredDoctor] = useState(false);
//   const [isHoveredServices, setIsHoveredServices] = useState(false);
//   const [isHoveredCategories, setIsHoveredCategories] = useState(false);

//   const [isDoctorMenuOpen, setIsDoctorMenuOpen] = useState(false);
//   const [isServicesMenuOpen, setIsServicesMenuOpen] = useState(false);
//   const [isCategoriesMenuOpen, setIsCategoriesMenuOpen] = useState(false);

//   const [showMobileMenu, setShowMobileMenu] = useState(false);

//   // const doctors = useMemo(() => getRandomDoctors(doctorsData, 5), []);
//   // const servicesList = getServiceNames(servicesData.dental, 6);

//   const [doctors, setDoctors] = useState([]);
//   const [servicesList, setServicesList] = useState([]);

//   useEffect(() => {
//     // Randomize only on client to avoid hydration mismatch
//     const randomDoctors = getRandomDoctors(doctorsData, 5);
//     const randomServices = getServiceNames(servicesData.dental, 6);

//     setDoctors(randomDoctors);
//     setServicesList(randomServices);
//   }, []);


//   const [categories, setCategories] = useState([]);

//   useEffect(() => {
//     const fetchData = async () => {
//       const data = await fetchCatData();
//       console.log("Fetched Categories:", data);
//       setCategories(data);
//     };
//     fetchData();
//   }, []);


//   const categoriesList = getServiceCategories(categories);


"use client";
import React, { useState, useEffect } from "react";
import Image from "next/image";
import Link from "next/link";
import { doctorsData } from "@/app/data/DoctorData";
import { fetchCatData } from "@/app/data/CatData";
import { getServicesData } from "@/app/data/ServicesData";

const MAIN_LOGO = process.env.NEXT_PUBLIC_MAIN_LOGO || "/fallback_logo.png";

const getRandomDoctors = (list, count = 5) => {
  const shuffled = [...list].sort(() => 0.5 - Math.random());
  return shuffled.slice(0, Math.min(count, shuffled.length)).map((doctor) => ({
    name: doctor.name,
    slug: doctor.slug,
    specialty: doctor.specialties,
  }));
};

const getServiceNames = (services, count = null) => {
  const simplified = services.map((item) => ({ name: item.name }));
  if (count !== null) {
    const shuffled = [...simplified].sort(() => 0.5 - Math.random());
    return shuffled.slice(0, Math.min(count, simplified.length));
  }
  return simplified;
};

const getServiceCategories = (catData) => {
  return catData.map((item) => ({ name: item.name }));
};

const Header = () => {
  const [isHoveredDoctor, setIsHoveredDoctor] = useState(false);
  const [isHoveredServices, setIsHoveredServices] = useState(false);
  const [isHoveredCategories, setIsHoveredCategories] = useState(false);

  const [isDoctorMenuOpen, setIsDoctorMenuOpen] = useState(false);
  const [isServicesMenuOpen, setIsServicesMenuOpen] = useState(false);
  const [isCategoriesMenuOpen, setIsCategoriesMenuOpen] = useState(false);

  const [showMobileMenu, setShowMobileMenu] = useState(false);

  const [doctors, setDoctors] = useState([]);



  const [groupedServices, setGroupedServices] = useState({});

  useEffect(() => {
    const fetchServices = async () => {
      const data = await getServicesData(); // { dental: [...], medical: [...] }
      console.log("Grouped Services:", data); // ✅ See all categories
      setGroupedServices(data);
    };

    fetchServices();
  }, []);

  
  // const [servicesList, setServicesList] = useState([]);
  const [servicesList, setServicesList] = useState([]);

  useEffect(() => {
    const fetchServices = async () => {
      const serviceData = await getServicesData();

      // Combine services from all categories
      const allServices = Object.values(serviceData).flat();

      // Optional: get random services (up to 6)
      const serviceNames = getServiceNames(allServices, 6);
      setServicesList(serviceNames);
    };

    fetchServices();
  }, []);

  
  const [categories, setCategories] = useState([]);

  useEffect(() => {
    setDoctors(getRandomDoctors(doctorsData, 5));
  }, []);

  useEffect(() => {
    const fetchServices = async () => {
      const serviceData = await getServicesData();
      const randomServices = getServiceNames(serviceData.dental || [], 6); // or "medical", "orthopedics", etc.
      setServicesList(randomServices);
    };

    fetchServices();
  }, []);

  useEffect(() => {
    const fetchCategories = async () => {
      const data = await fetchCatData();
      setCategories(data);
    };
    fetchCategories();
  }, []);

  const categoriesList = getServiceCategories(categories);

  return (
    <header className="px-8 py-4 rounded-b-xl shadow-md flex justify-center md:justify-between items-center bg-[var(--color-primary)] text-text relative">
      <div className="w-[100vw] p-4 md:p-0 md:w-auto">
        <Link href="/" className="flex items-center">
          <Image src={MAIN_LOGO} alt="Description" width={200} height={100} />
        </Link>
      </div>

      <div className="hidden md:flex items-center justify-center gap-4">
        <ul className="ff md:gap-2 lg:gap-10">
          {/* Doctor Dropdown */}
          <li
            className="relative list-none cursor-pointer"
            onMouseEnter={() => setIsHoveredDoctor(true)}
            onMouseLeave={() => setIsHoveredDoctor(false)}
          >
            <div className="ff">
              <span className="header_heading_lists">Doctor</span>
              <div
                className={`ml-1 transition-transform duration-300 ease-in-out ${
                  isHoveredDoctor ? "rotate-180" : "rotate-0"
                }`}
              >
                <Image
                  src="/svg/down_arrow.svg"
                  alt="Down Arrow"
                  width={20}
                  height={20}
                />
              </div>
            </div>

            <ul
              className={`absolute left-0 top-5 mt-2 w-48 bg-text text-primary rounded shadow-lg z-10 transition-opacity duration-800 divide-y divide-primary/30 ${
                isHoveredDoctor
                  ? "opacity-100 pointer-events-auto"
                  : "opacity-0 pointer-events-none"
              }`}
            >
              {doctors.map((doctor, idx) => (
                <li
                  key={idx}
                  className="px-4 py-2 hover:bg-secondary-text rounded-none"
                >
                  <Link href={`/Doctor/${doctor.slug}`}>
                    <div className="block cursor-pointer">
                      <span className="font-semibold">{doctor.name}</span>
                      <span className="text-xs text-primary/80 block">
                        {doctor.specialty}
                      </span>
                    </div>
                  </Link>
                </li>
              ))}
            </ul>
          </li>

          {/* Services Dropdown (was Dental) */}
          <li
            className="relative list-none cursor-pointer"
            onMouseEnter={() => setIsHoveredServices(true)}
            onMouseLeave={() => setIsHoveredServices(false)}
          >
            <div className="ff">
              <span className="header_heading_lists">Services</span>
              <div
                className={`ml-1 transition-transform duration-300 ease-in-out ${
                  isHoveredServices ? "rotate-180" : "rotate-0"
                }`}
              >
                <Image
                  src="/svg/down_arrow.svg"
                  alt="Down Arrow"
                  width={20}
                  height={20}
                />
              </div>
            </div>

            <ul
              className={`absolute left-0 top-5 mt-2 w-48 bg-text text-primary rounded shadow-lg z-10 transition-opacity duration-800 ${
                isHoveredServices
                  ? "opacity-100 pointer-events-auto"
                  : "opacity-0 pointer-events-none"
              }`}
            >
              {servicesList.map((service, idx) => (
                <li key={idx} className="px-4 py-2 hover:bg-[#e6f7fa]">
                  <span className="font-semibold">{service.name}</span>
                </li>
              ))}
            </ul>
          </li>

          {/* Categories Dropdown (was Medical) */}
          <li
            className="relative list-none cursor-pointer"
            onMouseEnter={() => setIsHoveredCategories(true)}
            onMouseLeave={() => setIsHoveredCategories(false)}
          >
            <div className="ff">
              <span className="header_heading_lists">Categories</span>
              <div
                className={`transition-transform duration-300 ease-in-out ${
                  isHoveredCategories ? "rotate-180" : "rotate-0"
                }`}
              >
                <Image
                  src="/svg/down_arrow.svg"
                  alt="Down Arrow"
                  width={20}
                  height={20}
                />
              </div>
            </div>

            <ul
              className={`absolute left-0 top-5 mt-2 w-48 bg-white text-[#11849B] rounded shadow-lg z-10 transition-opacity duration-800 ${
                isHoveredCategories
                  ? "opacity-100 pointer-events-auto"
                  : "opacity-0 pointer-events-none"
              }`}
            >
              {categoriesList.map((category, idx) => (
                <li key={idx} className="px-4 py-2 hover:bg-[#e6f7fa]">
                  <span className="font-semibold">{category.name}</span>
                </li>
              ))}
            </ul>
          </li>

          {/* Static Links */}
          <li className="list cursor-pointer">
            <span className="header_heading_lists">
              <Link href="/Blog">Blog</Link>
            </span>
          </li>
          <li className="list cursor-pointer">
            <span className="header_heading_lists">
              <Link href="/AboutUs">About Us</Link>
            </span>
          </li>
        </ul>
      </div>

      {/* Right button */}
      <div className="hidden md:flex items-center gap-4">
        <button className="bg-text text-[var(--color-primary)] font-semibold cursor-pointer px-4 py-2 rounded-lg">
          Book Appointment
        </button>
      </div>

      {/* Mobile Menu Icon */}
      <div className="md:hidden">
        <button
          className="bg-transparent border-none p-0"
          onClick={() => setShowMobileMenu(true)}
        >
          <Image
            src="/svg/hambuger.svg"
            alt="Menu Icon"
            width={30}
            height={30}
            className="cursor-pointer"
          />
        </button>
      </div>

      {/* Overlay */}
      {showMobileMenu && (
        <div
          className="fixed inset-0 z-40"
          onClick={() =>
            setIsDoctorMenuOpen(false) ||
            setIsServicesMenuOpen(false) ||
            setIsCategoriesMenuOpen(false) ||
            setShowMobileMenu(false)
          }
        ></div>
      )}

      {/* Sidebar Mobile Menu */}
      <div
        className={`fixed top-0 left-0 h-full w-full bg-[var(--color-primary)] z-50 shadow-lg transform transition-transform duration-300 ease-in-out ${
          showMobileMenu ? "translate-x-0" : "-translate-x-full"
        }`}
      >
        {/* Close Button */}
        <div className="p-4 flex justify-end">
          <button
            onClick={() => {
              setShowMobileMenu(false);
              setIsDoctorMenuOpen(false);
              setIsServicesMenuOpen(false);
              setIsCategoriesMenuOpen(false);
            }}
            className="text-white text-4xl"
          >
            &times;
          </button>
        </div>

        {/* Menu Items */}
        <div className="flex flex-col gap-4">
          <div className="flex items-center justify-center p-4">
            <Link href="/" onClick={() => setShowMobileMenu(false)}>
              <Image src={MAIN_LOGO} alt="Logo" width={250} height={150} />
            </Link>
          </div>
          <div>
            <ul className="flex justify-center flex-col gap-6 p-6 text-xl font-semibold text-text">
              <li>
                <Link href="/" onClick={() => setShowMobileMenu(false)}>
                  Home
                </Link>
              </li>

              {/* Doctor - Mobile */}
              <li className="flex flex-col gap-2 relative">
                <div
                  className="flex items-center justify-between cursor-pointer"
                  onClick={() => {
                    setIsDoctorMenuOpen(!isDoctorMenuOpen);
                    setIsServicesMenuOpen(false);
                    setIsCategoriesMenuOpen(false);
                  }}
                >
                  <span>
                    <Link href="#">Doctor</Link>
                  </span>
                  <Image
                    src="/svg/down_arrow.svg"
                    alt="Down Arrow"
                    width={20}
                    height={20}
                    className={`ml-1 transition-transform duration-300 ease-in-out ${
                      isDoctorMenuOpen ? "rotate-180" : "rotate-0"
                    }`}
                  />
                </div>
                {isDoctorMenuOpen && (
                  <ul className="bg-text text-[var(--color-primary)] rounded shadow-lg z-10 w-full transition-opacity duration-300 text-sm mt-2">
                    {doctors.map((doctor, idx) => (
                      <Link href={`/Doctor/${doctor.slug}`} onClick={() => {setShowMobileMenu(false);
                        setIsDoctorMenuOpen(false);
                      }} key={idx}>
                        <li
                          className="px-4 py-2 border-b last:border-b-0 border-[var(--color-secondary-text)]"
                        >
                          <span className="font-semibold">{doctor.name}</span>
                      </li>
                      </Link>
                    ))}
                  </ul>
                )}
              </li>

              {/* Services - Mobile */}
              <li className="flex flex-col gap-2 relative">
                <div
                  className="flex items-center justify-between cursor-pointer"
                  onClick={() => {
                    setIsServicesMenuOpen(!isServicesMenuOpen);
                    setIsDoctorMenuOpen(false);
                    setIsCategoriesMenuOpen(false);
                  }}
                >
                  <span>
                    <Link href="#">Services</Link>
                  </span>
                  <Image
                    src="/svg/down_arrow.svg"
                    alt="Down Arrow"
                    width={20}
                    height={20}
                    className={`ml-1 transition-transform duration-300 ease-in-out ${
                      isServicesMenuOpen ? "rotate-180" : "rotate-0"
                    }`}
                  />
                </div>
                {isServicesMenuOpen && (
                  <ul className="bg-text text-[var(--color-primary)] rounded shadow-lg z-10 w-full transition-opacity duration-300 text-sm mt-2">
                    {servicesList.map((service, idx) => (
                      <li
                        key={idx}
                        className="px-4 py-2 border-b last:border-b-0 border-[var(--color-secondary-text)]"
                      >
                        <span className="font-semibold">{service.name}</span>
                      </li>
                    ))}
                  </ul>
                )}
              </li>

              {/* Categories - Mobile */}
              <li className="flex flex-col gap-2 relative">
                <div
                  className="flex items-center justify-between cursor-pointer"
                  onClick={() => {
                    setIsCategoriesMenuOpen(!isCategoriesMenuOpen);
                    setIsDoctorMenuOpen(false);
                    setIsServicesMenuOpen(false);
                  }}
                >
                  <span>
                    <Link href="#">Categories</Link>
                  </span>
                  <Image
                    src="/svg/down_arrow.svg"
                    alt="Down Arrow"
                    width={20}
                    height={20}
                    className={`ml-1 transition-transform duration-300 ease-in-out ${
                      isCategoriesMenuOpen ? "rotate-180" : "rotate-0"
                    }`}
                  />
                </div>
                {isCategoriesMenuOpen && (
                  <ul className="bg-text text-[var(--color-primary)] rounded shadow-lg z-10 w-full transition-opacity duration-300 text-sm mt-2">
                    {categoriesList.map((cat, idx) => (
                      <li
                        key={idx}
                        className="px-4 py-2 border-b last:border-b-0 border-[var(--color-secondary-text)]"
                      >
                        <span className="font-semibold">{cat.name}</span>
                      </li>
                    ))}
                  </ul>
                )}
              </li>

              <li>
                <Link href="/Blog" onClick={() => setShowMobileMenu(false)}>
                  Blog
                </Link>
              </li>
              <li>
                <Link href="/AboutUs" onClick={() => setShowMobileMenu(false)}>
                  About Us
                </Link>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </header>
  );
};

export default Header;

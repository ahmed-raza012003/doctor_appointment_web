
  // // app/Doctors/[slug]/page.js
  // import { doctorsData } from "@/app/data/DoctorData";
  // import Connect from "./components/Connect";

  // export async function generateStaticParams() {
  //   return doctorsData.map((doctor) => ({
  //     slug: doctor.slug,
  //   }));
  // }

  // // ✅ FIXED: Make this an async function
  // export default async function page({ params }) {
  //   const { slug } = params;
  //   const doctor = doctorsData.find((doc) => doc.slug === slug);

  //   if (!doctor) {
  //     return <p className="text-red-500">Doctor not found</p>;
  //   }

  //   return (
  //     <main className="p-6  text-white rounded-lg my-3 ">
  //       <Connect doctor={doctor} />
  //     </main>
  //   );
  // }

// app/Doctor/[slug]/page.js

import { doctorsData } from "@/app/data/DoctorData";
import Connect from "./components/Connect"; // ✅ Make sure this path is correct

export const dynamic = "force-static";

export function generateStaticParams() {
  return doctorsData.map((doctor) => ({
    slug: doctor.slug,
  }));
}

export default function Page({ params }) {
  const doctor = doctorsData.find((doc) => doc.slug === params.slug);

  if (!doctor) {
    return <p className="text-red-500">Doctor not found</p>;
  }

  return (
    <main className="p-6 text-white rounded-lg my-3">
      <Connect doctor={doctor} />
    </main>
  );
}




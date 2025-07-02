
// app/Doctors/[slug]/page.js
import { doctorsData } from "@/app/data/DoctorData";
import Connect from "./components/Connect";

export async function generateStaticParams() {
  return doctorsData.map((doctor) => ({
    slug: doctor.slug,
  }));
}

// ✅ FIXED: Make this an async function
export default async function page({ params }) {
  const { slug } = params;
  const doctor = doctorsData.find((doc) => doc.slug === slug);

  if (!doctor) {
    return <p className="text-red-500">Doctor not found</p>;
  }

  return (
    <main className="p-6  text-white rounded-lg my-3 ">
      <Connect doctor={doctor} />
    </main>
  );
}
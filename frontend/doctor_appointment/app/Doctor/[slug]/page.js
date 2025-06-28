// app/Doctors/[slug]/page.js
import { doctorsData } from "@/app/data/DoctorData";
import Connect from "./components/Connect";

// Required for static export (next export)
export async function generateStaticParams() {
  return doctorsData.map((doctor) => ({
    slug: doctor.slug,
  }));
}

// Dynamic route component
export default function Page({ params }) {
  const { slug } = params;
  const doctor = doctorsData.find((doc) => doc.slug === slug);

  if (!doctor) {
    return <p className="text-red-500">Doctor not found</p>;
  }

  return (
    <main className="p-6 bg-primary text-white rounded-lg">
      <Connect doctor={doctor} />
    </main>
  );
}

// app/Doctors/[slug]/page.js
import { doctorsData } from "@/app/data/DoctorData";
import Connect from "./components/Connect";

export default function Page({ params }) {
  const { slug } = params;
  const doctor = doctorsData.find((doc) => doc.slug === slug);

  if (!doctor) {
    return <p>Doctor not found</p>; // or redirect or custom error
  }

  return (
    <main>
      <Connect doctor={doctor} />
    </main>
  );
}

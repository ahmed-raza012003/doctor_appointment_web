// app/api/doctor/route.js
import { NextResponse } from 'next/server';

export async function GET() {
  return NextResponse.json({
    name: "Dr. Tahir Kamal",
    specialties: "Dermatologist, Cosmetic Surgeon, Cosmetologist",
    qualifications: "MBBS, FCPS (Dermatology), MAACS (USA), DDSC (UK)",
    image: "/d1.jpg",
    isVerified: true,
    waitTime: "Under 15 Min",
    experience: "30 Years",
    satisfactionScore: "97%",
    satisfiedPatients: 771,
  });
}

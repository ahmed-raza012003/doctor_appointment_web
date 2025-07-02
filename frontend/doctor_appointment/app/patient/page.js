// app/book-appointment/page.js
"use client";

import { useRouter } from "next/navigation";
import Link from "next/link";

const Page = () => {
    const router = useRouter();

    return (
        <section className="p-6 min-h-screen bg-primary text-white rounded-xl my-4">
            <div className="max-w-3xl mt-10 mx-auto">
                <h1 className="text-4xl font-bold text-center mb-6">
                    Schedule Your Appointment with Trusted Doctors
                </h1>

                <p className="text-lg leading-8 text-justify">
                    Easily book appointments with top-rated doctors in just a few steps. Whether you are looking for a general physician, skin specialist, or cosmetic expert, we have verified professionals ready to help you.
                    <br /><br />
                    View detailed doctor profiles, clinic schedules, services offered, and real patient reviews to make the best healthcare decision. Choose between in-clinic visits or online consultations from home.
                    <br /><br />
                    Avoid waiting in lines — reserve your slot with our secure and easy-to-use system. Or contact us directly on WhatsApp to book your appointment.
                </p>

                <div className="flex flex-col items-center gap-4 mt-10 w-full">
                    <button
                        onClick={() =>
                            router.push(
                                `${process.env.NEXT_PUBLIC_BACKEND_URL}/register`
                            )
                        }
                        className="w-full max-w-md bg-text hover:bg-secondary-text text-primary font-bold ff py-4 px-8 rounded-lg text-lg flex items-center justify-center"
                    >
                        <span>📅</span>
                        <span className="ml-2">Book Your Appointment Now</span>
                    </button>

                    <Link
                        href="https://wa.me/923001234567?text=Hi,%20I%20want%20to%20book%20an%20appointment"
                        target="_blank"
                        rel="noopener noreferrer"
                        className="w-full max-w-md bg-green-500 hover:bg-green-600 text-white font-bold ff py-4 px-8 rounded-lg text-lg flex items-center justify-center"
                    >
                        <span>💬</span>
                        <span className="ml-2">Book via WhatsApp</span>
                    </Link>
                </div>
            </div>
        </section>
    );
};

export default Page;

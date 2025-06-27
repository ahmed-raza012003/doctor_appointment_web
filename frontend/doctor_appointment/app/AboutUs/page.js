import Image from "next/image";

export const page = () => {
  return (
    <main className="min-h-screen w-full rounded-2xl p-8 bg-primary text-text my-3">
      <section className="flex-row gap-4 sm:flex justify-between items-center">
        <div className="flex flex-col sm:max-w-1/2">
          <h1 className="text-3xl font-bold m-4 text-center">About Us</h1>
          <span className="flex gap-3 flex-col text-text px-2 sm:px-20">
            <p className="text-justify">
              INFO PhD is a trusted name in modern healthcare, offering
              comprehensive medical and dental services under one roof. Our
              mission is to provide high-quality, ethical, and patient-centered
              care with a focus on innovation and excellence.{" "}
            </p>

            <p className="text-justify">
              With a team of highly qualified doctors, dentists, and healthcare
              professionals, we are dedicated to delivering reliable diagnostic
              support, expert consultations, and advanced treatment options.
              From general checkups to specialized procedures, we ensure that
              every patient receives personalized care in a safe and comfortable
              environment.
            </p>

            <p className="text-justify">
              At INFO PhD, we believe in empowering our patients with the right
              knowledge and treatment plans. Our state-of-the-art facilities and
              commitment to clinical excellence make us a preferred choice for
              individuals and families seeking trusted healthcare solutions.
            </p>
          </span>
        </div>
        <div className="flex justify-center items-center mt-6 sm:mt-0">
          <Image
            src="/about-us.jpg"
            alt="About Us"
            width={1200}
            height={1200}
            className=" rounded-lg shadow-lg"
          />
        </div>
      </section>

      <section className="flex-row sm:flex w-full  justify-between text-start items-center gap-8 p-4 mt-8">
        <div className="min-w-1/2 flex flex-col  gap-4">
          <h1 className="text-2xl font-bold text-center">Our Vision</h1>
          <p className="px-16 text-justify">
            At INFO PhD, our vision is to be a trusted leader in medical and
            dental healthcare by setting new standards in quality, innovation,
            and patient care. We aim to build a future where every individual
            has access to expert, affordable, and compassionate healthcare —
            supported by modern technology and a commitment to excellence.
          </p>
        </div>
        <div className="min-w-1/2 flex flex-col mt-6 sm:mt-0 gap-4">
          <h1 className="text-2xl font-bold text-center">Our Mission</h1>
          <p className="px-16 text-justify">
            At INFO PhD, our mission is to deliver high-quality medical and
            dental services with professionalism, precision, and care. We are
            committed to enhancing patient health through advanced diagnostics,
            expert consultations, and personalized treatment solutions. By
            combining modern technology with a patient-first approach, we strive
            to make quality healthcare accessible, reliable, and trusted by all.
          </p>
        </div>
      </section>
    </main>
  );
};

export default page;

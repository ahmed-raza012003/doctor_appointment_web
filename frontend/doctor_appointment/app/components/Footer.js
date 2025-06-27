import Image from "next/image";
import Link from "next/link";

const Footer = () => {
  return (
    <footer className="bg-[var(--color-primary)] rounded-t-2xl text-text w-full gap-4  sm:flex items-start justify-between px-6 py-4 text-center">
      <section className="min-w-[30%] flex flex-col  gap-5 py-3">
        <Image src="/logo/main_logo.svg" alt="Logo" width={300} height={140} />
        <span className="text-start">
          INFO PhD is a professional company providing high-quality medical and
          dental services. Our mission is to deliver modern, reliable, and
          effective solutions to patients and healthcare providers, including
          diagnostic support, expert consultations, and treatment planning. INFO
          PhD stands for excellence, care, and trust in the healthcare industry.
        </span>
      </section>
      <section className="min-w-[30%] flex flex-col gap-8 p-3">
        <h1 className="text-start text-3xl font-semibold">Quick Links</h1>
        <ul className="flex flex-col text-start gap-2">
          {[
            { name: "Home", href: "/" },
            { name: "About Us", href: "/AboutUs" },
            { name: "Services", href: "/Services" },
            { name: "Blog", href: "/Blog" },
            { name: "Contact Us", href: "/ContactUs" },
          ].map((link, idx) => (
            <li key={idx}>
              <Link href={link.href} className="group relative inline-block">
                <span className="relative inline-block">
                  {link.name}
                  <span className="absolute left-0 -bottom-0.5 h-[2px] w-0 bg-text transition-all duration-300 group-hover:w-full"></span>
                </span>
              </Link>
            </li>
          ))}
        </ul>
      </section>
      <section className="min-w-[30%] flex flex-col gap-8 p-3">
        <h2 className="text-start text-3xl font-semibold">Contact Us</h2>
        <span className="text-start">
          Address: 6 & 7 Ground Floor, Precision Health and Dentistry, The
          Delicacy, Bahria Expressway, opposite Globe Roundabout, Phase 8 Bahria
          Town, Rawalpindi
        </span>
        
        <ul className="flex flex-col">
          <li className="flex items-center gap-2">
            <Image
              src="/svg/facebook.svg"
              alt="Facebook"
              width={30}
              height={30}
            />
            <a
              href="https://www.facebook.com"
              target="_blank"
              rel="noopener noreferrer"
            >
              Facebook
            </a>
          </li>
          <li className="flex items-center gap-2">
            <Image
              src="/svg/instagram.svg"
              alt="Instagram"
              width={30}
              height={30}
            />
            <a
              href="https://www.instagram.com"
              target="_blank"
              rel="noopener noreferrer"
            >
              Instagram
            </a>
          </li>
          <li className="flex items-center gap-2">
            <Image
              src="/svg/linkedin.svg"
              alt="Linkedin"
              width={30}
              height={30}
            />
            <a
              href="https://www.linkedin.com"
              target="_blank"
              rel="noopener noreferrer"
            >
              Linkedin
            </a>
          </li>
        </ul>
      </section>
    </footer>
  );
};

export default Footer;

import Image from 'next/image';

export const Header = ({ onSignUpClick }) => {
  return (
    <header className="rounded-br-3xl h-16 flex items-center justify-between px-4 md:px-10 bg-white shadow-sm z-10 fixed top-0">
      <div className="flex items-center">
        <Image
          src="/logo/main_logo.svg"
          alt="Logo"
          width={150}
          height={40}
          priority
        />
      </div>
      <div>
        {/* <button
          onClick={onSignUpClick}
          className="bg-[#21A4AD] text-white px-4 py-2 text-sm sm:text-base md:text-lg rounded-md hover:bg-[#3a6164] transition-all"
        >
          SignUp
        </button> */}
      </div>
    </header>
  );
};

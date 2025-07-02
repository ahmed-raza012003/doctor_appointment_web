// import React from "react";
// import Card from "./components/Card";
// import { servicesData } from "@/app/data/ServicesData";

// const Page = () => {
//   return (
//     <main className="p-8 bg-primary rounded-2xl my-3">
//       <section className="flex flex-col items-center justify-center gap-10">
//         <h1 className="text-3xl font-bold mb-8 text-center text-text">
//           Our Services
//         </h1>
//         <div>
//           <h2 className="text-2xl font-semibold mb-4 text-text">Dental</h2>
//           <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 justify-items-center">
//             {servicesData.dental.map((item, index) => (
//               <Card
//                 key={index}
//                 image="/service.png" // Placeholder image, replace with actual images if available
//                 heading={item.name}
//                 content={item.description}
//               />
//             ))}
//           </div>
//         </div>
//         <div>
//           <h2 className="text-2xl font-semibold mb-4 text-text">Medical</h2>
//           <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 justify-items-center">
//             {servicesData.medical.map((item, index) => (
//               <Card
//                 key={index}
//                 image="/service.png" // Placeholder image, replace with actual images if available
//                 heading={item.name}
//                 content={item.description}
//               />
//             ))}
//           </div>
//         </div>
//       </section>
//     </main>
//   );
// };

// export default Page;
"use client";
import React, { useEffect, useState } from "react";
import Card from "./components/Card";
import { getServicesData } from "@/app/data/ServicesData"; // API-based dynamic data

const Page = () => {
  const [servicesData, setServicesData] = useState({});

  useEffect(() => {
    const fetchData = async () => {
      const data = await getServicesData();
      setServicesData(data);
    };

    fetchData();
  }, []);

  return (
    <main className="p-8 bg-primary rounded-2xl my-3">
      <section className="flex flex-col items-center justify-center gap-10">
        <h1 className="text-3xl font-bold mb-8 text-center text-text">
          Our Services
        </h1>

        {Object.entries(servicesData).map(([categoryName, services]) => (
          <div key={categoryName} className="w-full">
            <h2 className="text-2xl font-semibold mb-4 text-text capitalize">
              {categoryName}
            </h2>
            <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 justify-items-center">
              {services.map((item, index) => (
                <Card
                  key={index}
                  image={item.image || "/ser.jpg"} // fallback image
                  // image={"/ser.jpg"} // fallback image

                  heading={item.name}
                  content={item.description}
                />
              ))}
            </div>
          </div>
        ))}
      </section>
    </main>
  );
};

export default Page;

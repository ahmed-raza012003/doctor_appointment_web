// /** @type {import('next').NextConfig} */
// const nextConfig = {};

// export default nextConfig;


/** @type {import('next').NextConfig} */
const nextConfig = {
  async rewrites() {
    return [
      {
        source: '/storage/:path*',
        destination: 'http://localhost:8000/storage/:path*',
      },
    ];
  },
//   output: 'export',
  images: {
    unoptimized: true, // required if using <Image />
    domains: ['localhost'],
  },
  // Optional: Set basePath if hosting in a subdirectory
};

export default nextConfig;
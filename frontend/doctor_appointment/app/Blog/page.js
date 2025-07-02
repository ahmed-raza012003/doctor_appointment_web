"use client";
import { useState , useEffect } from "react";
// import { BlogData } from "../data/BlogData";
import { fetchBlogData } from "@/app/data/BlogData";

import Card from "./components/Card";

const POSTS_PER_PAGE = 6;

// const metadata = {
//   title: "Our Blog | INFO PhD",
//   description: "Explore our latest articles on Dental and Medical topics.",
// };

const Page = () => {

  const [blogs, setBlogs] = useState([]);

  useEffect(() => {
    const loadData = async () => {
      const data = await fetchBlogData();
      setBlogs(data);
    };
    loadData();
  }, [blogs]);

  const BlogData = blogs || [];
  const [currentPage, setCurrentPage] = useState(1);

  const totalPages = Math.ceil(BlogData.length / POSTS_PER_PAGE);
  const startIndex = (currentPage - 1) * POSTS_PER_PAGE;
  const paginatedBlogs = BlogData.slice(startIndex, startIndex + POSTS_PER_PAGE);

  // Smart pagination generator
  const getPaginationRange = () => {
    const range = [];
    const delta = 2;

    for (let i = 1; i <= totalPages; i++) {
      if (
        i === 1 ||
        i === totalPages ||
        (i >= currentPage - delta && i <= currentPage + delta)
      ) {
        range.push(i);
      } else if (range[range.length - 1] !== "...") {
        range.push("...");
      }
    }

    return range;
  };

  return (
    <main className="px-4 md:px-12 lg:px-20 py-12 my-4 rounded-2xl bg-primary text-white">
      <h1 className="text-4xl font-bold text-text mb-10">Blog</h1>

      {/* Blog Cards */}
      <section className="mb-10">
        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 justify-items-center">
          {paginatedBlogs.map((blog, index) => (
            <Card
              key={index}
              image={blog.feature_image || '/ser.jpg'}
              heading={blog.title}
              content={blog.description_card}
              link={`/Blog/${blog.slug}`}
            />
          ))}
        </div>
      </section>

      {/* Smart Pagination UI */}
      <div className="flex justify-center gap-2 mt-6 flex-wrap">
        {getPaginationRange().map((page, index) =>
          page === "..." ? (
            <span key={index} className="px-3 py-2 text-white">...</span>
          ) : (
            <button
              key={page}
              onClick={() => setCurrentPage(page)}
              className={`px-4 py-2 rounded transition-all duration-200 ${
                currentPage === page
                  ? "bg-white text-black font-bold"
                  : "bg-none border border-white text-white hover:bg-white hover:text-black"
              }`}
            >
              {page}
            </button>
          )
        )}
      </div>
    </main>
  );
};

export default Page;

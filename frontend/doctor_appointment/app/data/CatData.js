import axios from "axios";

export const fetchCatData = async () => {
  try {
    const res = await axios.get(`${process.env.NEXT_PUBLIC_BACKEND_URL}/api/categories`);
    const categories = res.data.categories;

    return categories.map((cat) => ({
      name: cat.name,
      slug: cat.name.toLowerCase(),
      description: cat.description || "",
      image: cat.image || null,
    }));
  } catch (err) {
    console.error("Failed to fetch categories:", err.message);
    return [];
  }
};

export default fetchCatData;
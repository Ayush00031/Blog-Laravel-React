import BlogCard from "./BlogCard";
import { useState, useEffect, useCallback } from "react";

const Blogs = () => {
  const [blogs, setBlogs] = useState([]);
  const [keyword, setKeyword] = useState("");

  const fetchBlogs = useCallback(async () => {
    const res = await fetch("http://localhost:8000/api/blogs");
    const result = await res.json();
    setBlogs(result.data);
  }, []);

  const searchBlogs = async (e) => {
    e.preventDefault();

    const res = await fetch(
      "http://localhost:8000/api/blogs?keyword=" + keyword,
    );
    const result = await res.json();
    setBlogs(result.data);
  };

  const resetSearch = () => {
    fetchBlogs();
    setKeyword(""); // optional improvement
  };

  useEffect(() => {
    // eslint-disable-next-line react-hooks/set-state-in-effect
    fetchBlogs();
  }, [fetchBlogs]);

  return (
    <div className="container">
      <div className="d-flex justify-content-center pt-5 mb-4">
        <form onSubmit={searchBlogs}>
          <div className="d-flex">
            <input
              type="text"
              value={keyword}
              onChange={(e) => setKeyword(e.target.value)}
              className="form-control"
              placeholder="Search Blogs"
            />
            <button className="btn btn-dark ms-2">Search</button>
            <button
              type="button"
              onClick={resetSearch}
              className="btn btn-dark ms-2"
            >
              Reset
            </button>
          </div>
        </form>
      </div>

      <div className="d-flex justify-content-between pt-5 mb-4">
        <h4>Blogs</h4>
        <a href="/create" className="btn btn-dark">
          Create
        </a>
      </div>

      <div className="row">
        {blogs.map((blog) => (
          <BlogCard
            key={blog.id}
            blog={blog}
            blogs={blogs}
            setBlogs={setBlogs}
          />
        ))}
      </div>
    </div>
  );
};

export default Blogs;

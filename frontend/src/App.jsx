import "bootstrap/dist/css/bootstrap.min.css";
import { Route, Routes } from "react-router-dom";
import Blogs from "./components/Blogs";
import CreateBlog from "./components/CreateBlog";
import BlogDetail from "./components/BlogDetail";
import { ToastContainer } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import { Link } from "react-router-dom";
import EditBlog from "./components/EditBlog";

const App = () => {
  return (
    <>
      <div className="bg-dark text-center py-2 shadow-lg">
        <Link
          to="/"
          className="navbar-brand fs-3 fw-bold text-decoration-none text-white"
        >
          Blog App
        </Link>
      </div>
      <Routes>
        <Route path="/" element={<Blogs />} />
        <Route path="/create" element={<CreateBlog />} />
        <Route path="/blog/:id" element={<BlogDetail />} />
        <Route path="/blog/edit/:id" element={<EditBlog />} />
      </Routes>
      <ToastContainer />
    </>
  );
};
export default App;

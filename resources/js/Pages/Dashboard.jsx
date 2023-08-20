import { useEffect, useState } from "react";
import axios from "axios";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import ArticleCard from "@/components/Article/ArticleCard";
import SearchInput from "@/components/Article/SearchInput";
import ReactLoading from "react-loading";

export default function Dashboard(props) {
    const [articles, setArticles] = useState([]);
    const [loading, setLoading] = useState(false);
    const [query, setQuery] = useState("");
    useEffect(() => {
        axios
            .get(`articles?q=${query}`)
            .then((res) => {
                setArticles(res.data?.data);
                setLoading(false);
            })
            .catch((err) => {
                console.error(err);
                setLoading(false);
            });
    }, [query]);

    let debouncingTimer;
    const handleSearch = (e) => {
        clearTimeout(debouncingTimer);
        setLoading(true);
        debouncingTimer = setTimeout(() => {
            setQuery(e.target.value);
        }, 1500);
    };

    return (
        <AuthenticatedLayout
            auth={props.auth}
            errors={props.errors}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="container mx-auto px-4 py-12">
                <SearchInput
                    className="mb-3"
                    placeholder="Search"
                    onChange={handleSearch}
                />
                {articles.length > 0 && (
                    <p className="text-gray-500 mb-3">#{articles.length}</p>
                )}
                {loading && (
                    <ReactLoading
                        type="bubbles"
                        color="#38bdf8"
                        height={400}
                        width={375}
                        className="m-auto"
                    />
                )}
                <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    {articles.length > 0 &&
                        articles.map((article) => (
                            <ArticleCard article={article} />
                        ))}
                    {articles.length == 0 && (
                        <h2 className="text-lg font-bold text-gray-900 text-center">
                            There are not feeds to show
                        </h2>
                    )}
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

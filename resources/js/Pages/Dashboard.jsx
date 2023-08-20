import { useEffect, useState } from "react";
import axios from "axios";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";

export default function Dashboard(props) {
    const [articles, setArticles] = useState([]);
    useEffect(() => {
        axios
            .get("articles")
            .then((res) => {
                console.log(res);
                setArticles(res.data?.data);
            })
            .catch((err) => {
                console.error(err);
            });
    }, []);

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

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {articles &&
                        articles.map((article) => (
                            <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-3">
                                <a
                                    href={article.source_url}
                                    target="_blank"
                                    className="block p-6 text-gray-900"
                                >
                                    <h2 className="text-lg font-bold">
                                        {article.title}
                                    </h2>
                                    <date className="font-bold text-gray-500">
                                        {article.date}
                                    </date>
                                </a>
                            </div>
                        ))}
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

function SearchInput({ className, ...props }) {
    return (
        <div className=" relative " style={{ flexGrow: 0.6 }}>
            <input
                type="search"
                className={
                    className +
                    "  w-full text-sm  transition border focus:outline-none focus:border-gray-600 rounded py-2 px-5 pr-10  leading-normal"
                }
                {...props}
            />

            <button
                className="absolute focus:outline-none search-icon p-2"
                style={{ top: 4, right: 4 }}
            >
                <svg
                    className="fill-current pointer-events-none text-gray-800 w-4 h-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                >
                    <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                </svg>
            </button>
        </div>
    );
}

export default SearchInput;

const Navbar = () => {
    return <>
            <nav className="navbar navbar-expand-lg navbar-dark bg-primary">
            <div className="container">
                <a className="navbar-brand" href="/">MyNextApp</a>
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse" id="navbarNav">
                    <ul className="navbar-nav ms-auto">
                        {/* When user is authenticated */}
                        <li className="nav-item">
                            <a className="nav-link" href="/dashboard">Dashboard</a>
                        </li>
                        <li className="nav-item">
                            <button className="btn btn-danger ms-2">Logout</button>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link" href="/">Home</a>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link" href="/auth">Login</a>
                        </li> 
                    </ul>
                </div>
            </div>
        </nav>
    </>
};

export default Navbar;
// This is a simple Navbar component that can be used in a Next.js application.
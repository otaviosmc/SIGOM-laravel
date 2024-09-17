import NavLink from '@/Components/NavLink';
export default function ButtonAdmin({nome,rota}){
    return (
        <div className="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
            <NavLink href={route(rota)} active={route().current(rota)}>
                {nome}
            </NavLink>
        </div>
    )
}
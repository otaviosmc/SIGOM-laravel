import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, useForm, usePage } from '@inertiajs/react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';



export default function Area({auth, flash, area,blocos}) {
    const { delete: destroy, processing } = useForm();

    const handleDelete = (id) => {
        if (confirm('Tem certeza que deseja excluir esta área?')) {
            destroy(route('area.destroy', id));
        }
    };
    console.log(blocos);
    

    return (
        <AuthenticatedLayout
    user={auth.user}
    header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Áreas</h2>}
>
    <Head title="Página Inicial" />
    
    <div  className='max-w-7xl mx-auto sm:px-6 lg:px-8 py-12'>
                <form action={route('area.create')} method="GET" className="inline-flex items-center">

                    {/* Adicione o array de blocos como um campo oculto */}
                    <input type="hidden" name="blocos" value={JSON.stringify(blocos)} />

                    <button
                        type="submit"
                        className="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 false ms-4 my-2"
                    >
                        Cadastrar
                    </button> 
                </form>
            <table className='w-full'>
                <thead>
                    <th className='p-6 text-gray-900 dark:text-gray-100 border text-left px-6'>Nome da área</th>
                </thead>
                <tbody>
                    {area.map((ar) => (
                    <tr key={ar.id}>
                        <td className='p-6 text-gray-900 dark:text-gray-100 border'> {ar.nome}</td>
                        <td className='border text-center'>
                            <button
                                onClick={() => handleDelete(ar.id)}
                                disabled={processing}
                                className='px-2 py-1 font-bold text-red-600 hover:text-black-900 hover:bg-red-900 hover:text-white rounded-md transition'
                            >Excluir</button>
                        </td>
                    </tr>
                    ))}
                </tbody>
            </table>
    </div>


</AuthenticatedLayout>
    );
}

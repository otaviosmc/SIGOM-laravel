import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, useForm, usePage } from '@inertiajs/react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';



export default function Area({auth, flash, area,blocos}) {
    const { data, setData, post, errors, reset } = useForm({
        nome: '',
        bloco_id: '',
    });
    const { delete: destroy, processing } = useForm();

    const handleDelete = (id) => {
        if (confirm('Tem certeza que deseja excluir esta área?')) {
            destroy(route('area.destroy', id));
        }
    };
    const submit = (e) => {
        e.preventDefault();
        post(route('area.store'), {
            onSuccess: () => {
                reset();
            },
        });
    };
    console.log(blocos);
    

    return (
        <AuthenticatedLayout
    user={auth.user}
    header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Áreas</h2>}
>
    <Head title="Página Inicial" />
    <form onSubmit={submit} className="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
                <InputLabel htmlFor="nome" value="Nome da Área" />
                <TextInput
                    id="nome"
                    name="nome"
                    value={data.nome}
                    className="mt-1 block w-full"
                    autoComplete="nome"
                    isFocused={true}
                    onChange={(e) => setData('nome', e.target.value)}
                    required
                />
                <InputLabel htmlFor="bloco_id" value="Bloco" />
                <select
                    id="bloco_id"
                    name="bloco_id"
                    value={data.bloco_id}
                    className="mt-1 block w-full"
                    onChange={(e) => setData('bloco_id', e.target.value)}
                    required
                >
                    <option value="">Selecione um bloco</option>
                    {blocos.map((bloco) => (
                        <option key={bloco.id} value={bloco.id}>
                            {bloco.nome}
                        </option>
                    ))}
                </select>

                {flash.success && (
                    <div className="my-4 text-sm font-medium text-green-600">
                        {flash.success}
                    </div>
                )}

                <PrimaryButton className="ms-4 my-2" disabled={processing}>
                    Cadastrar
                </PrimaryButton>
            </form>
    
    <div  className='max-w-7xl mx-auto sm:px-6 lg:px-8 py-2'>
            <table className='w-full'>
                <thead>
                    <th className='p-6 text-gray-900 dark:text-gray-100 border text-left px-6'>Nome da área</th>
                    <th className='p-6 text-gray-900 dark:text-gray-100 border text-left px-6'>Bloco</th>
                </thead>
                <tbody>
                    {area.map((ar) => (
                    <tr key={ar.id}>
                        <td className='p-6 text-gray-900 dark:text-gray-100 border'> {ar.nome}</td>
                        <td className='p-6 text-gray-900 dark:text-gray-100 border'>{blocos.find((bloco) => bloco.id === ar.bloco_id)?.nome || 'Bloco não encontrado'}</td>
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

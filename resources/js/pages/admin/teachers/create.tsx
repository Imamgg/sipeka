import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/app/app-sidebar-layout';
import { Head, Link, useForm } from '@inertiajs/react';
import { ArrowLeft, Save, School, User } from 'lucide-react';
import { FormEvent } from 'react';
import { toast } from 'sonner';

export default function Create() {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        nip: '',
        place_of_birth: '',
        date_of_birth: '',
        gender: '',
        address: '',
        phone_number: '',
    });

    function handleSubmit(e: FormEvent) {
        e.preventDefault();
        post('/teachers', {
            onSuccess: () => {
                reset();
                toast.success('Guru berhasil ditambahkan');
            },
            onError: (errors) => {
                if (errors.general) {
                    toast.error(errors.general);
                }
            },
        });
    }

    return (
        <AppLayout>
            <Head title="Tambah Guru" />

            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-6">
                <div className="glass-card border-glow rounded-xl p-6 shadow-md">
                    <h1 className="deco-line text-2xl font-bold" style={{ '--line-color': 'rgba(99, 102, 241, 0.7)' } as React.CSSProperties}>
                        Tambah Guru Baru
                    </h1>
                    <p className="text-muted-foreground mt-1 max-w-2xl">
                        Lengkapi formulir di bawah untuk menambahkan data guru baru ke dalam sistem.
                    </p>
                </div>

                <div className="rounded-xl border p-6 shadow-md">
                    <div className="mb-6 flex items-center gap-2">
                        <Button variant="ghost" size="sm" asChild className="rounded-lg transition-all hover:bg-blue-50 dark:hover:bg-blue-900/20">
                            <Link href="/teachers">
                                <ArrowLeft className="mr-2 h-4 w-4" />
                                Kembali
                            </Link>
                        </Button>
                    </div>
                    <form onSubmit={handleSubmit} className="space-y-6">
                        <div className="rounded-lg border border-gray-200 bg-white p-5 shadow-sm transition-all hover:shadow dark:border-gray-700 dark:bg-gray-800">
                            <div className="mb-4 flex items-center gap-3">
                                <div className="rounded-full bg-blue-100 p-2 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                                    <User className="h-5 w-5" />
                                </div>
                                <h2 className="text-lg font-semibold dark:text-white">Informasi Akun</h2>
                            </div>
                            <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div className="space-y-2">
                                    <Label htmlFor="name" className="text-sm font-medium">
                                        Nama Lengkap <span className="text-red-500">*</span>
                                    </Label>
                                    <Input
                                        id="name"
                                        value={data.name}
                                        onChange={(e) => setData('name', e.target.value)}
                                        error={errors.name}
                                        className="rounded-md border-gray-300 transition-all focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700"
                                    />
                                    {errors.name && <p className="text-sm text-red-500">{errors.name}</p>}
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="email" className="text-sm font-medium">
                                        Email <span className="text-red-500">*</span>
                                    </Label>
                                    <Input
                                        id="email"
                                        type="email"
                                        value={data.email}
                                        onChange={(e) => setData('email', e.target.value)}
                                        error={errors.email}
                                        className="rounded-md border-gray-300 transition-all focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700"
                                    />
                                    {errors.email && <p className="text-sm text-red-500">{errors.email}</p>}
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="password" className="text-sm font-medium">
                                        Password <span className="text-red-500">*</span>
                                    </Label>
                                    <Input
                                        id="password"
                                        type="password"
                                        value={data.password}
                                        onChange={(e) => setData('password', e.target.value)}
                                        error={errors.password}
                                        className="rounded-md border-gray-300 transition-all focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700"
                                    />
                                    {errors.password && <p className="text-sm text-red-500">{errors.password}</p>}
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="password_confirmation" className="text-sm font-medium">
                                        Konfirmasi Password <span className="text-red-500">*</span>
                                    </Label>
                                    <Input
                                        id="password_confirmation"
                                        type="password"
                                        value={data.password_confirmation}
                                        onChange={(e) => setData('password_confirmation', e.target.value)}
                                        className="rounded-md border-gray-300 transition-all focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700"
                                    />
                                </div>
                            </div>
                        </div>

                        <div className="rounded-lg border border-gray-200 bg-white p-5 shadow-sm transition-all hover:shadow dark:border-gray-700 dark:bg-gray-800">
                            <div className="mb-4 flex items-center gap-3">
                                <div className="rounded-full bg-indigo-100 p-2 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400">
                                    <School className="h-5 w-5" />
                                </div>
                                <h2 className="text-lg font-semibold dark:text-white">Informasi Guru</h2>
                            </div>
                            <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div className="space-y-2">
                                    <Label htmlFor="nip" className="text-sm font-medium">
                                        NIP <span className="text-red-500">*</span>
                                    </Label>
                                    <Input
                                        id="nip"
                                        value={data.nip}
                                        onChange={(e) => setData('nip', e.target.value)}
                                        error={errors.nip}
                                        className="rounded-md border-gray-300 transition-all focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700"
                                    />
                                    {errors.nip && <p className="text-sm text-red-500">{errors.nip}</p>}
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="place_of_birth" className="text-sm font-medium">
                                        Tempat Lahir <span className="text-red-500">*</span>
                                    </Label>
                                    <Input
                                        id="place_of_birth"
                                        value={data.place_of_birth}
                                        onChange={(e) => setData('place_of_birth', e.target.value)}
                                        error={errors.place_of_birth}
                                        className="rounded-md border-gray-300 transition-all focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700"
                                    />
                                    {errors.place_of_birth && <p className="text-sm text-red-500">{errors.place_of_birth}</p>}
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="date_of_birth" className="text-sm font-medium">
                                        Tanggal Lahir <span className="text-red-500">*</span>
                                    </Label>
                                    <Input
                                        id="date_of_birth"
                                        type="date"
                                        value={data.date_of_birth}
                                        onChange={(e) => setData('date_of_birth', e.target.value)}
                                        error={errors.date_of_birth}
                                        className="rounded-md border-gray-300 transition-all focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700"
                                    />
                                    {errors.date_of_birth && <p className="text-sm text-red-500">{errors.date_of_birth}</p>}
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="gender" className="text-sm font-medium">
                                        Jenis Kelamin <span className="text-red-500">*</span>
                                    </Label>
                                    <Select value={data.gender} onValueChange={(value) => setData('gender', value)}>
                                        <SelectTrigger
                                            id="gender"
                                            className={`border-gray-300 transition-all focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 ${errors.gender ? 'border-red-500' : ''}`}
                                        >
                                            <SelectValue placeholder="Pilih jenis kelamin" />
                                        </SelectTrigger>{' '}
                                        <SelectContent className="border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                                            <SelectItem value="M">Laki-laki</SelectItem>
                                            <SelectItem value="F">Perempuan</SelectItem>
                                        </SelectContent>
                                    </Select>
                                    {errors.gender && <p className="text-sm text-red-500">{errors.gender}</p>}
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="phone_number" className="text-sm font-medium">
                                        Nomor Telepon <span className="text-red-500">*</span>
                                    </Label>
                                    <Input
                                        id="phone_number"
                                        value={data.phone_number}
                                        onChange={(e) => setData('phone_number', e.target.value)}
                                        error={errors.phone_number}
                                        className="rounded-md border-gray-300 transition-all focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700"
                                    />
                                    {errors.phone_number && <p className="text-sm text-red-500">{errors.phone_number}</p>}
                                </div>
                            </div>
                            <div className="mt-4 space-y-2">
                                <Label htmlFor="address" className="text-sm font-medium">
                                    Alamat <span className="text-red-500">*</span>
                                </Label>
                                <Textarea
                                    id="address"
                                    value={data.address}
                                    onChange={(e) => setData('address', e.target.value)}
                                    className={`rounded-md border-gray-300 transition-all focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 ${errors.address ? 'border-red-500' : ''}`}
                                    rows={3}
                                />
                                {errors.address && <p className="text-sm text-red-500">{errors.address}</p>}
                            </div>
                        </div>

                        <div className="flex justify-end gap-2">
                            <Button
                                type="button"
                                variant="outline"
                                asChild
                                className="rounded-lg transition-all hover:bg-gray-100 hover:shadow-sm dark:hover:bg-gray-700/50"
                            >
                                <Link href="/teachers">Batal</Link>
                            </Button>
                            <Button
                                type="submit"
                                disabled={processing}
                                className="rounded-lg bg-gradient-to-r from-indigo-500 to-blue-500 text-white shadow-sm transition-all hover:shadow"
                            >
                                <Save className="mr-2 h-4 w-4" />
                                {processing ? 'Menyimpan...' : 'Simpan'}
                            </Button>
                        </div>
                    </form>
                </div>
            </div>
        </AppLayout>
    );
}

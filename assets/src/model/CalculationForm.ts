import { CompanySymbol } from "./CompanySymbol";

export interface CalculationForm {
    startDate: Date,
    endDate: Date,
    companySymbol: CompanySymbol|null,
    email: string|null,
}
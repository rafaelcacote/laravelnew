import { type Component } from 'vue';

export interface ColumnDef {
  key: string;
  header: string;
  class?: string;
  cellClass?: string;
  format?: (value: any) => string;
  render?: Component;
}